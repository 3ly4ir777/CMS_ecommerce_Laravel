<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        return Inertia::render('cms/dashboard', [
            'products' => Product::latest()->get(),
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string|max:100',
        ]);

        Product::create($validated);

        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back();
    }
}
