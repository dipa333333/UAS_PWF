@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Tambah Menu Baru</h2>

    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Nama Menu</label>
            <input type="text" name="name" class="w-full border p-2 rounded" required placeholder="Contoh: Nasi Goreng Spesial">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Foto Menu</label>
            <input type="file" name="image" class="w-full border p-2 rounded">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WEBP. Maks: 2MB</p>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Kategori</label>
            <select name="category_id" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Harga Asli (Rp)</label>
                <input type="number" name="price" class="w-full border p-2 rounded" required placeholder="15000">
            </div>
            <div>
                <label class="block mb-1 font-semibold text-red-600">Harga Promo (Opsional)</label>
                <input type="number" name="discount_price" class="w-full border border-red-200 bg-red-50 p-2 rounded" placeholder="Contoh: 12000">
                <p class="text-xs text-red-500 mt-1">Isi jika sedang diskon. Kosongkan jika harga normal.</p>
            </div>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Stok Awal</label>
            <input type="number" name="stock" class="w-full border p-2 rounded" required value="10" min="0">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Deskripsi</label>
            <textarea name="description" class="w-full border p-2 rounded h-24" placeholder="Deskripsi singkat menu..."></textarea>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full font-bold">Simpan Menu</button>
        <div class="text-center mt-2">
            <a href="{{ route('menus.index') }}" class="text-gray-500 text-sm hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection