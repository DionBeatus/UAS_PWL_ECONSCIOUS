<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::orderBy('id', 'desc')->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_date' => ['required', 'date'],
            'store_name' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        Purchase::create([
            'purchase_date' => $validated['purchase_date'],
            'store_name' => $validated['store_name'],
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'total' => $validated['total'],
        ]);

        return redirect()->route('purchases.index')
            ->with('success', 'Pembelian berhasil ditambahkan.');
    }

    public function edit(Purchase $purchase)
    {
        $products = Product::all();
        return view('purchases.edit', compact('purchase', 'products'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'purchase_date' => ['required', 'date'],
            'store_name' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        $purchase->update([
            'purchase_date' => $validated['purchase_date'],
            'store_name' => $validated['store_name'],
            'user_id' => Auth::id(),
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'total' => $validated['total'],
        ]);

        return redirect()->route('purchases.index')
            ->with('success', 'Pembelian berhasil diupdate.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()->route('purchases.index')
            ->with('success', 'Pembelian berhasil dihapus.');
    }
}