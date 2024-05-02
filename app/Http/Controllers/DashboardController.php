<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        $categories = Category::all();
        $orders = collect();
        $users = User::all();
        $totalPricesByMonth = [];

        if (auth()->user()->role == 'restaurant_manager') {
            $orders = Order::where('restaurant_id', auth()->user()->restaurant->id)->where('status', 'in_kitchen')->get();
        }

        if (auth()->user()->role == 'admin') {
            $orders = Order::all();

            for ($i = 0; $i < 12; $i++) {
                $month = Carbon::now()->subMonths($i)->startOfMonth();
                $totalPricesByMonth[] = Order::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->sum('total_price');
            }
        }

        return view('dashboard', compact('restaurants', 'categories', 'orders', 'users', 'totalPricesByMonth'));
    }

    public function sales()
    {
        $orders = Order::where('restaurant_id', auth()->user()->restaurant->id)->where('status', 'finish')->whereDate('created_at', Carbon::today())->get();
        $orders_overall = Order::where('restaurant_id', auth()->user()->restaurant->id)->where('status', 'finish')->get();

        $total_sales = 0;
        foreach ($orders as $key => $order) {
            $total_sales = $total_sales + $order->total_price;
        }

        $total_sales_overall = 0;
        foreach ($orders_overall as $key => $order_overall) {
            $total_sales_overall = $total_sales_overall + $order_overall->total_price;
        }

        for ($i = 0; $i < 12; $i++) {
            $month = Carbon::now()->subMonths($i)->startOfMonth();
            $totalPricesByMonth[] = Order::where('restaurant_id', auth()->user()->restaurant->id)->where('status', 'finish')->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_price');
        }

        return view('order.sales', compact('orders', 'total_sales', 'total_sales_overall', 'orders_overall', 'totalPricesByMonth'));
    }
}
