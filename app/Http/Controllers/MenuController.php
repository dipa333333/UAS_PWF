<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // 1. Tampilkan Daftar Menu
    public function index(Request $request)
    {
        $search = $request->input('search');

        $menus = Menu::with('category')
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhereHas('category', function($q) use ($search) {
                                 $q->where('name', 'like', "%{$search}%");
                             });
            })
            ->latest()
            ->paginate(10);

        $menus->appends(['search' => $search]);

        return view('menus.index', compact('menus'));
    }

    // 2. Halaman Tambah Menu
    public function create()
    {
        $categories = Category::all();
        return view('menus.create', compact('categories'));
    }

    // 3. Simpan Menu Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|integer|min:0',
        ]);

        $data = $request->all();

        if (!$request->filled('discount_price')) {
            $data['discount_price'] = null;
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menu-images', 'public');
        }

        Menu::create($data);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambah!');
    }

    // 4. Halaman Detail Menu
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    // 5. Halaman Edit Menu
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('menus.edit', compact('menu', 'categories'));
    }

    // 6. Update Menu
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:2048',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|integer|min:0',
        ]);

        $data = $request->all();

        // Handle logika harga coret
        if (!$request->filled('discount_price')) {
            $data['discount_price'] = null;
        }

        if ($request->hasFile('image')) {
            if ($menu->image) Storage::disk('public')->delete($menu->image);
            $data['image'] = $request->file('image')->store('menu-images', 'public');
        }

        $menu->update($data);

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diupdate!');
    }

    // 7. Hapus Menu
    public function destroy(Menu $menu)
    {
        if ($menu->image) Storage::disk('public')->delete($menu->image);
        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}