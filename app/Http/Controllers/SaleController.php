<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Validation\Rule;
use App\Models\Product;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::orderBy('id', 'desc')->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        Sale::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'total' => $validated['total'],
        ]);

        return redirect()->route('sales.index')
            ->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    public function edit(Sale $sale)
    {
        $products = Product::all();
        return view('sales.edit', compact('sale', 'products'));
    }

    public function update(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        $sale->update($validated);

        return redirect()->route('sales.index')
            ->with('success', 'Data penjualan berhasil diupdate.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()->route('sales.index')
            ->with('success', 'Data penjualan berhasil dihapus.');
    }
}
