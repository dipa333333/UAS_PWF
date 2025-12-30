<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Menu
        $totalMenus = Menu::count();

        // 2. Hitung Menu Tersedia (LOGIKA BARU: Stok > 0)
        $availableMenus = Menu::where('stock', '>', 0)->count();

        // 3. Hitung Menu Habis (LOGIKA BARU: Stok <= 0)
        $soldOutMenus = Menu::where('stock', '<=', 0)->count();

        // 4. Data untuk Grafik (Jumlah Menu per Kategori)
        $categories = Category::withCount('menus')->get();
        $chartLabels = $categories->pluck('name');
        $chartData = $categories->pluck('menus_count');

        // 5.Tambahkan fitur "Menu Hampir Habis" (Misal stok < 5)
        $lowStockMenus = Menu::where('stock', '>', 0)
                             ->where('stock', '<', 5)
                             ->orderBy('stock', 'asc')
                             ->get();

        return view('dashboard', compact(
            'totalMenus',
            'availableMenus',
            'soldOutMenus',
            'chartLabels',
            'chartData',
            'lowStockMenus'
        ));
    }
}