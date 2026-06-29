<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationDetail;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with(['details.product', 'user'])->orderBy('donation_date', 'desc')->paginate(10);

        return view('donations.index', compact('donations'));
    }

    public function create()
    {
        $products = Product::where('source_type', 'donation')->orderBy('product_name')->get();

        return view('donations.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donation_date' => ['required', 'date'],
            'donor_name' => ['required'],
            'products' => ['required', 'array'],
            'quantities' => ['required', 'array'],
        ]);

        $donation = Donation::create([
            'user_id' => Auth::id(),
            'donation_date' => $request->donation_date,
            'donor_name' => $request->donor_name,
        ]);

        foreach ($request->products as $index => $productId) {

            $qty = (int) $request->quantities[$index];

            DonationDetail::create([
                'donation_id' => $donation->id,
                'product_id' => $productId,
                'quantity' => $qty,
            ]);

            $stock = Stock::firstOrCreate(
                [   'product_id' => $productId],
                [
                    'user_id' => Auth::id(),
                    'quantity' => 0,
                ]
            );

            $stock->user_id = Auth::id();
            $stock->quantity += $qty;
            $stock->save();
        }

        return redirect()->route('donations.index')->with('success', 'Data donasi berhasil ditambahkan.');
    }

    public function show(Donation $donation)
    {
        $donation->load('details.product', 'user');

        return view('donations.show', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        $products = Product::where('source_type', 'donation')->orderBy('product_name')->get();

        $donation->load('details');

        return view('donations.edit', compact('donation', 'products'));
    }

    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'donation_date' => ['required', 'date'],
            'donor_name' => ['required'],
            'products' => ['required', 'array'],
            'quantities' => ['required', 'array'],
        ]);

        foreach ($donation->details as $detail) {

            $stock = Stock::where('product_id', $detail->product_id)->first();

            if ($stock) {
                $stock->user_id = Auth::id();
                $stock->quantity -= $detail->quantity;
                $stock->save();
            }
        }

        $donation->details()->delete();

        $donation->update([
            'user_id' => Auth::id(),
            'donation_date' => $request->donation_date,
            'donor_name' => $request->donor_name,
        ]);

        foreach ($request->products as $index => $productId) {

            $qty = (int) $request->quantities[$index];

            DonationDetail::create([
                'donation_id' => $donation->id,
                'product_id' => $productId,
                'quantity' => $qty,
            ]);

            $stock = Stock::firstOrCreate(
                [   'product_id' => $productId],
                [
                    'user_id' => Auth::id(),
                    'quantity' => 0,
                ]
            );

            $stock->user_id = Auth::id();
            $stock->quantity += $qty;
            $stock->save();
        }

        return redirect()->route('donations.index')->with('success', 'Data donasi berhasil diupdate.');
    }

    public function destroy(Donation $donation)
    {
        foreach ($donation->details as $detail) {

            $stock = Stock::where('product_id', $detail->product_id)->first();

            if ($stock) {
                $stock->user_id = Auth::id();
                $stock->quantity -= $detail->quantity;
                $stock->save();
            }
        }

        $donation->delete();

        return redirect()->route('donations.index')->with('success', 'Data donasi berhasil dihapus.');
    }
}