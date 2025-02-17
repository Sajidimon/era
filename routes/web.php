<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesFunnelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Middleware\DisabledRegistration;
use App\Http\Middleware\ValidAdmin;
use Illuminate\Support\Facades\Route;



Route::middleware(ValidAdmin::class)->group(function () {


    //dashboard home page route:
    Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    //products route:
    Route::get('/admin/products', [ProductController::class, 'index'])->name('products');
    Route::get('/admin/create-product', [ProductController::class, 'create'])->name('create');
    Route::post('/create-product', [ProductController::class, 'store'])->name('store');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('destroy');
    Route::patch('/update-product/{id}', [ProductController::class, 'update'])->name('update');

    //funnels route:
    Route::get('/admin/funnels', [SalesFunnelController::class, 'index'])->name('funnels');
    Route::get('/admin/create-funnel', [SalesFunnelController::class, 'create'])->name('create');
    Route::post('/create-funnel', [SalesFunnelController::class, 'store'])->name('store');
    Route::get('/funnel/{id}/edit', [SalesFunnelController::class, 'edit'])->name('edit');
    Route::patch('/update-funnel/{id}', [SalesFunnelController::class, 'update'])->name('update');
    Route::delete('/delete-funnel/{id}', [SalesFunnelController::class, 'destroy'])->name('destroy');

    //orders route:
    Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/admin/create-order', [OrderController::class, 'create'])->name('create');
    Route::post('/manual-order', [OrderController::class, 'storeOrderManually'])->name('OrderManual');
    Route::delete('/delete-order/{id}', [OrderController::class, 'destroy'])->name('destroy');
    Route::get('/order/{id}/edit', [OrderController::class, 'edit'])->name('edit');
    Route::patch('/update-order/{id}', [OrderController::class, 'update'])->name('update');

    //settings route:
    Route::get('/admin/settings', [SettingController::class, 'settings'])->name('settings');
    Route::patch('/update-settings', [SettingController::class, 'updateSettings'])->name('updateSettings');

});

Route::middleware('guest')->group(function () {

    //home page route:
    Route::get('/', [HomeController::class, 'home'])->name('home');

    //single funnel route:
    Route::get('/funnel/{name}', [SalesFunnelController::class, 'show'])->name('show');

    //order route:
    Route::post('/create-order', [OrderController::class, 'store'])->name('store');

    //auth routes:
    Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware(DisabledRegistration::class);
    Route::post('/register', [AuthController::class, 'store'])->name('store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //error route:
    Route::get('/404', [SettingController::class, 'error'])->name('error');

});