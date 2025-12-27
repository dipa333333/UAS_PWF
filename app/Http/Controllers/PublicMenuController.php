<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicMenuController extends Controller
{
    public function index(Request $request)
    {
        $categoryName = $request->query('category');
        $search = $request->query('search');

        // Ambil semua kategori untuk tab filter di atas
        $categories = Category::all();

        // Query Menu
        $menus = Menu::with('category')
            ->where('stock', '>', 0) 

            // Filter Kategori
            ->when($categoryName, function($q) use ($categoryName) {
                return $q->whereHas('category', function($subQuery) use ($categoryName) {
                    $subQuery->where('name', $categoryName);
                });
            })

            // Filter Search
            ->when($search, function($q) use ($search) {
                return $q->where(function($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                          ->orWhereHas('category', function($subQuery) use ($search) {
                              $subQuery->where('name', 'like', "%{$search}%");
                          });
                });
            })
            ->latest()
            ->get();

        return view('public.index', compact('menus', 'categories'));
    }

    public function show(Menu $menu)
    {
        return view('public.show', compact('menu'));
    }
}