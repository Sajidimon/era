<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SalesFunnel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SalesFunnelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $funnels = SalesFunnel::with('products')->latest()->paginate(5);
        return Inertia::render('Admin/SalesFunnel/Funnel', [
            'funnels' => $funnels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return Inertia::render('Admin/SalesFunnel/CreateFunnel', [
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'subheading' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);


        $path = $request->file('image')->storeAs('images', time() . '_' . $request->file('image')->getClientOriginalName(), 'public');

        $funnel = SalesFunnel::create([
            'title' => $request->input('title'),
            'subheading' => $request->input('subheading'),
            'image' => $path,
        ]);

        $funnel->products()->attach($request->product_ids);

        return redirect()->back()->with('success', 'Funnel created successfull');
    }

    /**
     * Display the specified resource.
     */
    public function show($funnel)
    {
        $formattedTitle = str_replace('-', ' ', $funnel);
        $funnel = SalesFunnel::with('products')->where('title', $formattedTitle)->first();
        return Inertia::render('User/Home', [
            'funnel' => $funnel,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $funnel = SalesFunnel::with('products')->find($id);
        return Inertia::render('Admin/SalesFunnel/EditFunnel', [
            'funnel' => $funnel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'subheading' => 'required|string',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
        ]);

        $funnel = SalesFunnel::find($id);

        $funnel->update([
            'title' => $request->input('title'),
            'subheading' => $request->input('subheading'),
        ]);

        if ($request->hasFile('image')) {

            if($funnel->image){
                Storage::disk('public')->delete($funnel->image);
            }

            $path = $request->file('image')->storeAs('images', time() . '_' . $request->file('image')->getClientOriginalName(), 'public');
            $funnel->update([
                'image' => $path,
            ]);
        }

        $funnel->products()->sync($request->product_ids);

        return redirect()->route('funnels');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $funnel = SalesFunnel::find($id);
        $funnel->delete();

        if($funnel->image){
            Storage::disk('public')->delete($funnel->image);
        }

        return redirect()->back();

    }
}
