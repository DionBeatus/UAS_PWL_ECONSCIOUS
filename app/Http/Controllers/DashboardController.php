<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $totalSales = Sale::count();
        $totalRevenue = Sale::sum('total');

        $lowStock = Product::where('stock', '<', 6)->get();
        $recentSales = Sale::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalProducts',
            'totalStock',
            'totalSales',
            'totalRevenue',
            'lowStock',
            'recentSales'
        ));

        $salesChart = Sale::select(
            \DB::raw('DATE(created_at) as date'),
            \DB::raw('SUM(total) as total')
        )
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        $salesChartData = $salesChart->map(function ($item) {
            return [
                'date' => $item->date,
                'total' => $item->total,
            ];
        });

        return view('dashboard', compact(
            'totalProducts',
            'totalStock',
            'totalSales',
            'totalRevenue',
            'lowStock',
            'recentSales',
            'salesChartData'
        ));
    }
}
