@extends('layouts.app')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Daftar Pesanan Masuk</h2>
        <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg font-bold text-sm">
            Total Hari Ini: 5 Pesanan
        </div>
    </div>

    <!-- Statistik Ringkas (Dummy) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-blue-500 flex justify-between items-center">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Pesanan Baru</p>
                <h3 class="text-2xl font-bold text-blue-600">1</h3>
            </div>
            <div class="p-2 bg-blue-50 rounded-full text-blue-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-yellow-500 flex justify-between items-center">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Sedang Dimasak</p>
                <h3 class="text-2xl font-bold text-yellow-600">2</h3>
            </div>
            <div class="p-2 bg-yellow-50 rounded-full text-yellow-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-green-500 flex justify-between items-center">
            <div>
                <p class="text-xs text-gray-500 font-bold uppercase">Selesai</p>
                <h3 class="text-2xl font-bold text-green-600">2</h3>
            </div>
            <div class="p-2 bg-green-50 rounded-full text-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>
    </div>

    <!-- Tabel Pesanan -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs tracking-wider border-b">
                <tr>
                    <th class="p-5 font-bold">ID & Waktu</th>
                    <th class="p-5 font-bold">Pelanggan</th>
                    <th class="p-5 font-bold">Detail Pesanan</th>
                    <th class="p-5 font-bold">Total</th>
                    <th class="p-5 font-bold text-center">Status</th>
                    <th class="p-5 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($orders as $order)
                <tr class="hover:bg-gray-50 transition">
                    <!-- ID & Waktu -->
                    <td class="p-5 align-top">
                        <span class="font-bold text-gray-800 block">#{{ $order['id'] }}</span>
                        <span class="text-xs text-gray-500 flex items-center gap-1 mt-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $order['time'] }}
                        </span>
                    </td>

                    <!-- Pelanggan -->
                    <td class="p-5 align-top">
                        <div class="font-bold text-gray-900">{{ $order['customer_name'] }}</div>
                        <a href="https://wa.me/{{ $order['whatsapp'] }}" target="_blank" class="text-xs text-green-600 hover:underline flex items-center gap-1 mt-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            Hubungi via WA
                        </a>
                    </td>

                    <!-- Detail Menu -->
                    <td class="p-5 align-top">
                        <ul class="text-sm text-gray-700 space-y-1">
                            @foreach($order['items'] as $item)
                                <li class="flex items-center gap-2">
                                    <span class="bg-gray-200 text-gray-700 text-[10px] font-bold px-1.5 rounded">{{ $item['qty'] }}x</span>
                                    {{ $item['name'] }}
                                </li>
                            @endforeach
                        </ul>
                    </td>

                    <!-- Total -->
                    <td class="p-5 align-top font-bold text-gray-800">
                        Rp {{ number_format($order['total'], 0, ',', '.') }}
                    </td>

                    <!-- Status -->
                    <td class="p-5 align-top text-center">
                        @if($order['status'] == 'Baru')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 animate-pulse">
                                <span class="w-1.5 h-1.5 bg-blue-600 rounded-full mr-1.5"></span>
                                Baru
                            </span>
                        @elseif($order['status'] == 'Diproses')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                <span class="w-1.5 h-1.5 bg-yellow-600 rounded-full mr-1.5 animate-bounce"></span>
                                Diproses
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Selesai
                            </span>
                        @endif
                    </td>

                    <!-- Aksi -->
                    <td class="p-5 align-top text-center">
                        <button class="text-gray-400 hover:text-blue-600 transition" title="Lihat Detail / Ubah Status">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection