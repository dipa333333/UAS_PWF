@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md mt-6">
    <div class="mb-6 border-b pb-4">
        <h2 class="text-xl font-bold text-gray-900">Tambah Kategori Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Buat kategori untuk mengelompokkan menu restoran Anda.</p>
    </div>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
            <input type="text"
                   name="name"
                   id="name"
                   class="shadow-sm focus:ring-orange-500 focus:border-orange-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border"
                   required
                   placeholder="Contoh: Makanan Berat, Minuman, Dessert"
                   value="{{ old('name') }}">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end space-x-3">
            <a href="{{ route('categories.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                Simpan Kategori
            </button>
        </div>
    </form>
</div>
@endsection