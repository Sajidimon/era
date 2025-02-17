<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);
        return Inertia::render('Admin/Products/Products', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Products/CreateProduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'regular' => 'required|string',
            'discount' => 'nullable|string',
            'category' => 'required|string',
            'stock' => 'nullable|string',
            'description' => 'required',
            'thumbnail' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);


        $path = $request->file('thumbnail')->storeAs('images', time() . '_' . $request->file('thumbnail')->getClientOriginalName(), 'public');

        Product::create([
            'name' => $request->input('name'),
            'regular' => $request->input('regular'),
            'discount' => $request->input('discount'),
            'category' => $request->input('category'),
            'stock' => $request->input('stock'),
            'description' => $request->input('description'),
            'thumbnail' => $path,
        ]);

        return redirect()->back()->with('success', 'product created successfull');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return Inertia::render('Admin/Products/EditProduct', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'regular' => 'nullable|string',
            'discount' => 'nullable|string',
            'category' => 'nullable|string',
            'stock' => 'nullable|string',
            'description' => 'nullable',
            'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('thumbnail')) {

            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            $path = $request->file('thumbnail')->storeAs('images', time() . '_' . $request->file('thumbnail')->getClientOriginalName(), 'public');
            $validatedData['thumbnail'] = $path;
        } else {
            $validatedData['thumbnail'] = $product->thumbnail;
        }

        $product->update($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        if ($product->thumbnail) {
            Storage::disk('public')->delete($product->thumbnail);
        }
    }
}
