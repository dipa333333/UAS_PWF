@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800">Laporan Kas Keuangan</h2>
        <div class="flex gap-2">
            <a href="{{ route('reports.export_pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                Export PDF
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-emerald-500">
            <p class="text-xs text-gray-500 uppercase font-bold">Total Pemasukan</p>
            <h3 class="text-2xl font-bold text-emerald-600">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500">
            <p class="text-xs text-gray-500 uppercase font-bold">Total Pengeluaran</p>
            <h3 class="text-2xl font-bold text-red-600">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</h3>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
            <p class="text-xs text-gray-500 uppercase font-bold">Saldo Akhir</p>
            <h3 class="text-2xl font-bold text-blue-600">Rp {{ number_format($saldo, 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-6 py-4 text-sm font-bold text-gray-600">Tanggal</th>
                    <th class="px-6 py-4 text-sm font-bold text-gray-600">Keterangan</th>
                    <th class="px-6 py-4 text-sm font-bold text-gray-600">Jenis</th>
                    <th class="px-6 py-4 text-sm font-bold text-gray-600 text-right">Jumlah</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($reports as $r)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $r['tanggal'] }}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $r['keterangan'] }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $r['tipe'] == 'masuk' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                            {{ $r['tipe'] }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-bold text-right {{ $r['tipe'] == 'masuk' ? 'text-emerald-600' : 'text-red-600' }}">
                        {{ $r['tipe'] == 'masuk' ? '+' : '-' }} Rp {{ number_format($r['jumlah'], 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection