@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Menu</h2>

    <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Nama Menu</label>
            <input type="text" name="name" value="{{ old('name', $menu->name) }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Foto Menu</label>
            @if($menu->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="Foto Menu" class="w-32 h-32 object-cover rounded border">
                </div>
            @endif
            <input type="file" name="image" class="w-full border p-2 rounded">
            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengganti foto.</p>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Kategori</label>
            <select name="category_id" class="w-full border p-2 rounded" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Harga Asli (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $menu->price) }}" class="w-full border p-2 rounded" required>
            </div>
            <div>
                <label class="block mb-1 font-semibold text-red-600">Harga Promo (Opsional)</label>
                <input type="number" name="discount_price" value="{{ old('discount_price', $menu->discount_price) }}" class="w-full border border-red-200 bg-red-50 p-2 rounded">
                <p class="text-xs text-red-500 mt-1">Kosongkan untuk menghapus diskon.</p>
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Sisa Stok</label>
            <input type="number" name="stock" value="{{ old('stock', $menu->stock) }}" class="w-full border p-2 rounded" required min="0">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="description" class="w-full border p-2 rounded h-24">{{ old('description', $menu->description) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full font-bold">Update Menu</button>
        <div class="text-center mt-2">
            <a href="{{ route('menus.index') }}" class="text-gray-500 text-sm hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection