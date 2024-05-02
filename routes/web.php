<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.index');
Route::get('/order/sales', [DashboardController::class, 'sales'])->middleware(['auth', 'verified'])->name('order.sales');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');
    Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');
    Route::get('/restaurant/ban/{restaurant}', [RestaurantController::class, 'ban'])->name('restaurant.ban');
    Route::get('/restaurant/approve/{restaurant}', [RestaurantController::class, 'approve'])->name('restaurant.approved');
    Route::get('/restaurant/placeOrder/{menu}', [RestaurantController::class, 'placeOrder'])->name('restaurant.placeOrder');
    Route::get('/restaurant/reject_order/{order}', [RestaurantController::class, 'rejectOrder'])->name('restaurant.rejectOrder');
    Route::get('/restaurant/finish_order/{order}', [RestaurantController::class, 'finishOrder'])->name('restaurant.finishOrder');
    Route::get('/order-details/{order}', [RestaurantController::class, 'orderDetails'])->name('restaurant.orderDetails');
    Route::post('/restaurant/payment', [RestaurantController::class, 'payment'])->name('restaurant.payment');
    Route::get('/payment/success', function () {
        return view('payment-success');
    })->name('payment.success');
    
    Route::get('/payment/failure', function () {
        return view('payment-failure');
    })->name('payment.failure');
});

require __DIR__.'/auth.php';
