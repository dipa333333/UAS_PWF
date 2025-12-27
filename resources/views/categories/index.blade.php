@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="max-w-4xl mx-auto">

    <!-- HEADER -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Manajemen Kategori</h2>
            <p class="text-sm text-gray-500">Kelola daftar kategori menu</p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 rounded-md bg-orange-600 text-white text-sm font-semibold hover:bg-orange-700">
            + Tambah Kategori
        </a>
    </div>

    <!-- TABLE -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase">
                        Nama Kategori
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">
                        Jumlah Menu
                    </th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase">
                        Aksi
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($categories as $category)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">
                        {{ $category->name }}
                    </td>

                    <td class="px-6 py-4 text-center text-sm">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-semibold">
                            {{ $category->menus->count() }} Menu
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center text-sm">
                        <div class="flex justify-center gap-4">
                            <a href="{{ route('categories.edit', $category->id) }}"
                               class="text-indigo-600 hover:text-indigo-900 font-medium">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('categories.destroy', $category->id) }}"
                                  onsubmit="return confirm('Yakin hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-800 font-medium">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-6">
                        Belum ada kategori.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
