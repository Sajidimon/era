<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\SalesFunnel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return Inertia::render('Admin/Orders/Orders', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $funnels = SalesFunnel::with('products')->get();
        return Inertia::render('Admin/Orders/CreateOrder', [
            'funnels' => $funnels
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        Order::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'total' => $request->input('total'),
            'sales_funnel_id' => $request->input('sales_funnel_id'),
        ]);

        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     */

    public function storeOrderManually(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'sales_funnel_id' => 'required',
            'status' => 'required',
        ]);

        Order::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'total' => $request->input('total'),
            'status' => $request->input('status'),
            'sales_funnel_id' => $request->input('sales_funnel_id'),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $funnels = SalesFunnel::with('products')->get();
        $order = Order::with('funnel')->findOrFail($id);
        return Inertia::render('Admin/Orders/EditOrder', [
            'funnels' => $funnels,
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $order = Order::with('funnel')->findOrFail($id);

        $request->validate([
            'name' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'sales_funnel_id' => 'nullable',
            'status' => 'nullable',
        ]);

        $order->update([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'total' => $request->input('total'),
            'status' => $request->input('status'),
            'sales_funnel_id' => $request->input('sales_funnel_id'),
        ]);

        return redirect()->route('orders');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->back();
    }
}
