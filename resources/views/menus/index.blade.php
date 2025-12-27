@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Menu</h2>
        <a href="{{ route('menus.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white px-5 py-2 rounded shadow transition flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Menu
        </a>
    </div>

    <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
        <form action="{{ route('menus.index') }}" method="GET" class="flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Cari menu berdasarkan nama atau kategori..."
                   class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Cari</button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4 border border-green-200 flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-200">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs tracking-wider">
                <tr>
                    <th class="p-4 border-b">Foto</th>
                    <th class="p-4 border-b">Nama Menu</th>
                    <th class="p-4 border-b">Kategori</th>
                    <th class="p-4 border-b">Harga</th> 
                    <th class="p-4 border-b text-center">Stok</th>
                    <th class="p-4 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($menus as $menu)
                <tr class="hover:bg-gray-50 transition">
                    <td class="p-4 w-20">
                        @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                        @else
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-xs text-gray-500 font-bold">IMG</div>
                        @endif
                    </td>
                    <td class="p-4 font-bold text-gray-800">
                        {{ $menu->name }}
                        @if($menu->discount_price && $menu->discount_price < $menu->price)
                            <span class="ml-2 inline-block bg-red-100 text-red-600 text-[10px] px-2 py-0.5 rounded-full font-bold">PROMO</span>
                        @endif
                    </td>
                    <td class="p-4 text-sm text-gray-600">
                        <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-xs font-bold">
                            {{ $menu->category->name ?? 'Tanpa Kategori' }}
                        </span>
                    </td>

                    <!-- PERBAIKAN LOGIKA HARGA -->
                    <td class="p-4">
                        @if($menu->discount_price && $menu->discount_price < $menu->price)
                            <div class="flex flex-col">
                                <span class="text-xs text-red-400 line-through">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                <span class="text-green-600 font-bold">Rp {{ number_format($menu->discount_price, 0, ',', '.') }}</span>
                            </div>
                        @else
                            <span class="font-bold text-gray-700">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                        @endif
                    </td>

                    <td class="p-4 text-center">
                        @if($menu->stock > 5)
                            <span class="text-green-600 font-bold bg-green-100 px-3 py-1 rounded-full text-xs">
                                {{ $menu->stock }}
                            </span>
                        @elseif($menu->stock > 0)
                            <span class="text-orange-600 font-bold bg-orange-100 px-3 py-1 rounded-full text-xs animate-pulse">
                                Sisa {{ $menu->stock }}
                            </span>
                        @else
                            <span class="text-red-600 font-bold bg-red-100 px-3 py-1 rounded-full text-xs">
                                HABIS
                            </span>
                        @endif
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <a href="{{ route('menus.show', $menu->id) }}" class="text-gray-400 hover:text-blue-600 transform hover:scale-110 transition" title="Lihat Detail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>
                            <a href="{{ route('menus.edit', $menu->id) }}" class="text-gray-400 hover:text-yellow-500 transform hover:scale-110 transition" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a>
                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transform hover:scale-110 transition" title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-gray-300 mb-3"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                            <p class="text-lg font-medium">Belum ada menu</p>
                            <p class="text-sm">Silakan tambahkan menu baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $menus->links() }}
    </div>
</div>
@endsection