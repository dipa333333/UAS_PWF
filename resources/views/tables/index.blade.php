@extends('layouts.app')

@section('content')
<div x-data="{ open:false, tableId:null }" class="space-y-8">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">
                Manajemen Meja & Reservasi
            </h2>
            <p class="text-sm text-slate-500">
                Kelola status meja dan permintaan reservasi pelanggan
            </p>
        </div>

        <div class="flex flex-wrap gap-3 text-sm font-medium">
            <span class="px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                Kosong: {{ $availableTables }}
            </span>

            <span class="px-4 py-1.5 rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                Pending: {{ \App\Models\Reservation::where('status','pending')->count() }}
            </span>

            <span class="px-4 py-1.5 rounded-full bg-slate-100 text-slate-700 border">
                Total Meja: {{ $totalTables }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2">
            <h3 class="text-lg font-semibold mb-4 text-slate-700">Denah Meja</h3>

            <a href="{{ route('tables.create') }}"
            class="px-4 py-2 bg-slate-800 text-white text-sm rounded-lg hover:bg-slate-900 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Tambah Meja
            </a>

            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
                @foreach($tables as $table)
                <div
                    class="rounded-2xl border bg-white shadow-sm hover:shadow-md transition p-4 flex flex-col justify-between">

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-slate-800">
                                {{ $table->name }}
                            </span>

                            <span class="text-xs px-2 py-1 rounded-full border
                                {{ $table->status === 'kosong'
                                    ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                                    : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($table->status) }}
                            </span>
                        </div>

                        <p class="text-xs text-slate-500 mb-4">
                            Kapasitas {{ $table->capacity }} orang
                        </p>
                    </div>

                    <form method="POST" action="{{ route('tables.update', $table->id) }}" class="space-y-2">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="name" value="{{ $table->name }}">
                        <input type="hidden" name="capacity" value="{{ $table->capacity }}">

                        @if($table->status === 'kosong')
                            <button name="status" value="terisi"
                                class="w-full py-2 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition">
                                Isi Tamu
                            </button>

                            <button type="button"
                                @click="open=true; tableId={{ $table->id }}"
                                class="w-full py-2 rounded-lg bg-amber-100 text-amber-700 hover:bg-amber-200 transition">
                                Set Reservasi
                            </button>
                        @else
                            <button name="status" value="kosong"
                                class="w-full py-2 rounded-lg border text-slate-600 hover:bg-slate-100 transition">
                                Kosongkan
                            </button>
                        @endif
                    </form>
                </div>
                @endforeach
            </div>
        </div>

        <div>
            <h3 class="text-lg font-semibold mb-4 text-slate-700">
                Permintaan Reservasi
            </h3>

            <div class="bg-white border rounded-2xl overflow-hidden shadow-sm">
                <ul class="divide-y">
                    @forelse($reservations as $res)
                    <li class="p-4 hover:bg-slate-50 transition">

                        <div class="flex justify-between gap-3">
                            <div>
                                <div class="font-semibold text-slate-800">
                                    {{ $res->name }}
                                </div>

                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $res->pax }} orang • {{ $res->reservation_time->format('H:i') }}
                                </div>
                            </div>

                            <a href="https://wa.me/{{ $res->phone }}" target="_blank"
                               class="px-3 py-2 rounded-lg bg-emerald-100 text-emerald-700 hover:bg-emerald-200 transition">
                                WA
                            </a>
                        </div>

                        {{-- ACTION --}}
                        @if($res->status === 'pending')
                        <div class="grid grid-cols-2 gap-2 mt-4">
                            <form method="POST" action="{{ route('reservations.update',$res->id) }}">
                                @csrf @method('PATCH')
                                <button name="status" value="confirmed"
                                    class="w-full py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                                    Terima
                                </button>
                            </form>

                            <form method="POST" action="{{ route('reservations.update',$res->id) }}">
                                @csrf @method('PATCH')
                                <button name="status" value="cancelled"
                                    class="w-full py-2 rounded-lg bg-slate-200 text-slate-700 hover:bg-slate-300 transition">
                                    Tolak
                                </button>
                            </form>
                        </div>

                        @elseif($res->status === 'confirmed')
                        <form method="POST" action="{{ route('reservations.update',$res->id) }}" class="mt-4">
                            @csrf @method('PATCH')
                            <button name="status" value="done"
                                onclick="return confirm('Tandai reservasi ini sebagai selesai?')"
                                class="w-full py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700 transition">
                                ✅ Selesai
                            </button>
                        </form>

                        @else
                        <div class="mt-3 text-center text-xs font-semibold text-slate-500">
                            Reservasi selesai
                        </div>
                        @endif
                    </li>
                    @empty
                    <li class="p-6 text-center text-slate-400">
                        Belum ada reservasi
                    </li>
                    @endforelse
                </ul>

                <div class="p-4 border-t bg-slate-50">
                    {{ $reservations->links('partials.pagination') }}
                </div>
            </div>
        </div>
    </div>

    <div x-show="open" x-cloak
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

        <div @click.away="open=false"
             class="bg-white w-full max-w-md rounded-2xl p-6">

            <h3 class="text-lg font-semibold mb-4">Tambah Reservasi (Admin)</h3>

            <form method="POST" action="{{ route('reservations.store') }}" class="space-y-3">
                @csrf

                <input type="hidden" name="table_id" :value="tableId">

                <input type="hidden" name="status" value="confirmed">

                <input name="name" placeholder="Nama Tamu"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-orange-200" required>

                <input name="phone" placeholder="No WhatsApp (08xxx)"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-orange-200" required>

                <input type="number" name="pax" placeholder="Jumlah orang"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-orange-200" required>

                <input type="time" name="reservation_time"
                       class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-orange-200" required>

                <div class="flex justify-end gap-2 pt-4">
                    <button type="button" @click="open=false"
                        class="px-4 py-2 text-slate-600 hover:text-slate-800">
                        Batal
                    </button>

                    <button
                        class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition">
                        Simpan & Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection