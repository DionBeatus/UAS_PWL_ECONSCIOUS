<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use Illuminate\Validation\Rule;
use App\Models\Product;
use Google\Client;
use Google\Service\Sheets;

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
            'product_name' => ['required', Rule::in(['EcoChain', 'LoopKnot'])],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'integer'],
        ]);

        $validated['total'] = $validated['quantity'] * $validated['price'];

        Sale::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'product_name' => $validated['product_name'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'total' => $validated['total'],
        ]);

        $this->sendToGoogleSheets($validated);

        return redirect()->route('sales.index')
            ->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    private function sendToGoogleSheets($data, $range = 'Sheet1!A:F', $spreadsheetId = '1m6axF5UJw0HJhWvDbs9hUAlvaPVK7vMHZAVYwLoOWLw')
    {
        try {
            \Log::info('Testing Sheets API', [
                'spreadsheetId' => $spreadsheetId,
                'range' => $range,
                'data'  => $data
            ]);
            $client = new \Google\Client();
            $client->setAuthConfig(storage_path('app/google.json'));
            $client->addScope(\Google\Service\Sheets::SPREADSHEETS);

            $service = new \Google\Service\Sheets($client);

            $spreadsheetId = '1m6axF5UJw0HJhWvDbs9hUAlvaPVK7vMHZAVYwLoOWLw';
            $range = 'Sheet1!A:F';

            $values = [[
                $data['customer_name'],
                $data['customer_email'],
                $data['product_name'],
                $data['quantity'],
                $data['price'],
                $data['total'],
            ]];

            $body = new \Google\Service\Sheets\ValueRange(['values' => $values]);
            $params = ['valueInputOption' => 'RAW'];

            $service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);

            \Log::info('Data berhasil dikirim ke Google Sheets', $data);
        } catch (\Exception $e) {
            \Log::error('Gagal kirim ke Google Sheets: ' . $e->getMessage());
        }
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
            'product_name' => ['required', Rule::in(['EcoChain', 'LoopKnot'])],
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
