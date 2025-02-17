<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesFunnel;
use App\Models\Order;
use Inertia\Inertia;

class HomeController extends Controller
{
    //this method will display admin dashboard
    public function dashboard()
    {
        $products = Product::all();
        $funnels = SalesFunnel::all();
        $orders = Order::all();
        return Inertia::render('Admin/Dashboard', [
            'products' => $products,
            'funnels' => $funnels,
            'orders' => $orders,
        ]);
    }
    //this method will display home
    public function home()
    {
        return Inertia::render('User/Home');
    }
}
