<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductChangesLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $recentProducts = Product::latest()->take(5)->get();
        $expensiveProducts = Product::orderBy('price', 'desc')->take(5)->get();
        $products = Product::paginate(5);

        return view('products.index', compact('recentProducts', 'expensiveProducts', 'products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = Product::create($request->all());

        DB::table('product_changes_logs')->insert([
            'product_id' => $product->id,
            'action' => 'create',
            'changes' => json_encode($product->toArray()),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $oldProduct = $product->toArray();
        $product->update($request->all());

        DB::table('product_changes_logs')->insert([
            'product_id' => $product->id,
            'action' => 'update',
            'changes' => json_encode([
                'old' => $oldProduct,
                'new' => $product->toArray(),
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        DB::table('product_changes_logs')->insert([
            'product_id' => $product->id,
            'action' => 'delete',
            'changes' => json_encode($product->toArray()),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
