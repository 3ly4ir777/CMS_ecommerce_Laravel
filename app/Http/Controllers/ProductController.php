<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('cms/dashboard', [
            'products' => Product::with('category')->latest()->get(),
            'categories' => Category::withCount('products')->get(),
            'clients' => User::withCount('orders')->latest()->get(),
            'stats' => [
                'total_products' => Product::count(),
                'total_stock' => Product::sum('stock'),
                'total_orders' => Order::count(),
                'pending_orders' => Order::where('status', 'pendiente')->count(),
                'revenue' => Order::whereIn('status', ['pagada', 'enviada', 'entregada'])->sum('total'),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:2048',
            'is_active' => 'boolean',
        ]);

        Product::create($validated);

        return redirect()->back();
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|string|max:2048',
            'is_active' => 'boolean',
        ]);

        $product->update($validated);

        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }
}