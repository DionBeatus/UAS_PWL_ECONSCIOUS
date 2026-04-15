<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('id', 'desc')->paginate(10);
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buyer_name' => ['required', 'string', 'max:255'],
            'product_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        // hitung total (sama seperti SaleController)
        $validated['total'] = $validated['quantity'] * $validated['price'];

        Supplier::create([
            'buyer_name' => $validated['buyer_name'],
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'total' => $validated['total'],
        ]);

        return redirect()->route('suppliers.index')
            ->with('success', 'Pembelian berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'buyer_name' => ['required', 'string', 'max:255'],
            'product_name' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        // hitung ulang total
        $validated['total'] = $validated['quantity'] * $validated['price'];

        $supplier->update([
            'buyer_name' => $validated['buyer_name'],
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'total' => $validated['total'],
        ]);

        return redirect()->route('suppliers.index')
            ->with('success', 'Pembelian berhasil diupdate.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')
            ->with('success', 'Pembelian berhasil dihapus.');
    }
}
