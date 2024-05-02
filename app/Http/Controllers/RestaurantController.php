<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyPoint;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Charge;
use Stripe\Stripe;

class RestaurantController extends Controller
{
    /**
     */
    public function show(Request $request, Restaurant $restaurant): View
    {
        $menus = Menu::where('restaurant_id', $restaurant->id)->get();
        return view('restaurant.show', compact('restaurant', 'menus'));
    }

    public function orderDetails(Request $request, Order $order): View
    {
        return view('order-details', compact('order'));
    }

    public function placeOrder(Request $request, Menu $menu)
    {
        return view('restaurant.place-order', compact('menu'));
    }
    
    public function rejectOrder(Request $request, Order $order)
    {
        $order->update(['status' => 'reject']);

        return back()->with('success', 'Order rejected successfully');
    }

    public function finishOrder(Request $request, Order $order)
    {
        $order->update(['status' => 'finish']);

        return back()->with('success', 'Order finished.');
    }

    public function ban(Request $request, Restaurant $restaurant)
    {
        $restaurant->update(['status' => false]);

        return back()->with('success', 'Restaurant Banned.');
    }

    public function approve(Request $request, Restaurant $restaurant)
    {
        $restaurant->update(['status' => true]);

        return back()->with('success', 'Restaurant approved.');
    }

    public function payment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $menu = Menu::find($request->menu_id);

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'restaurant_id' => $menu->restaurant_id,
            'menu_id' => $menu->id,
            'type' => $request->address ? 'delivery' : 'pickup',
            'status' => 'in_kitchen',
            'total_price' => $menu->price,
            'address' => $request->address,
            'street_name' => $request->street_name,
            'house_no' => $request->house_no,
            'apartment_no' => $request->apartment_no,
        ]);

        $loyalty = LoyaltyPoint::create([
            'user_id' => auth()->user()->id,
            'points' => $order->total_price,
        ]);

        $session = Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'myr',
                        'product_data' => [
                            'name' => $menu->name,
                        ],
                        'unit_amount'  => $menu->price * 100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('restaurant.orderDetails', $order->id),
            'cancel_url'  => route('dashboard.index'),
        ]);

        $request->session()->flash('success', 'Payment Success. Your order has been placed.');

        return redirect()->away($session->url);
    }
}
