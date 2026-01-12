@extends('layouts.app')

@section('title', 'Detail Menu')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Breadcrumb / Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('menus.index') }}" class="inline-flex items-center text-gray-600 hover:text-blue-600 transition font-medium">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Menu
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden flex flex-col md:flex-row">

        <!-- BAGIAN KIRI: Foto Menu -->
        <div class="md:w-5/12 bg-gray-100 relative min-h-[300px] md:min-h-full group">
            @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" class="w-full h-full object-cover absolute inset-0 transition transform duration-700 group-hover:scale-105">
            @else
                <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                    <svg class="w-16 h-16 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-sm font-medium">Tidak ada foto</span>
                </div>
            @endif

            <!-- Badge Kategori -->
            <div class="absolute top-4 left-4">
                <span class="bg-white/90 backdrop-blur text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                    {{ $menu->category->name ?? 'Uncategorized' }}
                </span>
            </div>

            <!-- Badge Status Stok -->
            <div class="absolute bottom-4 left-4">
                @if($menu->stock > 5)
                    <span class="bg-green-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        Stok Tersedia: {{ $menu->stock }}
                    </span>
                @elseif($menu->stock > 0)
                    <span class="bg-orange-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm animate-pulse">
                        Stok Menipis: {{ $menu->stock }}
                    </span>
                @else
                    <span class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                        Stok Habis
                    </span>
                @endif
            </div>
        </div>

        <!-- BAGIAN KANAN: Informasi Detail -->
        <div class="md:w-7/12 p-8 flex flex-col">
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <h1 class="text-3xl font-extrabold text-gray-900 mb-2 leading-tight">{{ $menu->name }}</h1>

                    <!-- Tombol Aksi Kecil -->
                    <div class="flex gap-2">
                        <a href="{{ route('menus.edit', $menu->id) }}" class="p-2 text-gray-400 hover:text-yellow-500 hover:bg-yellow-50 rounded-lg transition" title="Edit">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Harga dengan Logika Diskon -->
                <div class="mt-4 mb-6 p-4 bg-gray-50 rounded-xl border border-gray-100 inline-block min-w-[200px]">
                    <p class="text-xs text-gray-500 font-bold uppercase tracking-wide mb-1">Harga Satuan</p>
                    @if($menu->discount_price && $menu->discount_price < $menu->price)
                        <div class="flex items-center gap-3">
                            <span class="text-3xl font-extrabold text-green-600">Rp {{ number_format($menu->discount_price, 0, ',', '.') }}</span>
                            <div class="flex flex-col">
                                <span class="text-sm text-red-400 line-through">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                <span class="text-[10px] font-bold text-white bg-red-500 px-1.5 py-0.5 rounded">
                                    Hemat {{ round((($menu->price - $menu->discount_price) / $menu->price) * 100) }}%
                                </span>
                            </div>
                        </div>
                    @else
                        <span class="text-3xl font-extrabold text-gray-800">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                    @endif
                </div>

                <div class="mb-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-2">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        {{ $menu->description ?: 'Tidak ada deskripsi untuk menu ini.' }}
                    </p>
                </div>
            </div>

            <!-- QR Code & Public Link -->
            <div class="mt-8 pt-6 border-t border-gray-100 bg-blue-50/50 -mx-8 -mb-8 px-8 py-6">
                <div class="flex flex-col sm:flex-row items-center gap-6">

                    <div class="bg-white p-2 rounded-lg shadow-sm border border-gray-200">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ route('public.show', $menu->id) }}" alt="QR Code" class="w-20 h-20">
                    </div>

                    <div class="flex-1 text-center sm:text-left">
                        <h4 class="text-sm font-bold text-gray-800 mb-1">Preview Halaman Pelanggan</h4>
                        <p class="text-xs text-gray-500 mb-3">Scan QR Code di samping atau klik tombol di bawah untuk melihat tampilan menu ini di sisi pelanggan.</p>

                        <a href="{{ route('public.show', $menu->id) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-bold rounded-lg hover:bg-blue-700 transition shadow-sm hover:shadow-md">
                            Lihat Tampilan Publik
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Hapus -->
    <div class="mt-8 flex justify-end">
        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menu ini akan dihapus permanen. Lanjutkan?');">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center gap-2 px-4 py-2 hover:bg-red-50 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Hapus Menu Ini
            </button>
        </form>
    </div>
</div>
@endsection