@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Meja Baru</h2>

    <form action="{{ route('tables.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block mb-2 font-bold text-sm text-gray-700">Nama Meja</label>
            <input type="text" name="name" class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" required placeholder="Contoh: Meja 05 (Outdoor)">
        </div>

        <div>
            <label class="block mb-2 font-bold text-sm text-gray-700">Kapasitas (Orang)</label>
            <input type="number" name="capacity" class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition" required value="4" min="1">
        </div>

        <div>
            <label class="block mb-2 font-bold text-sm text-gray-700">Status Awal</label>
            <select name="status" class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition">
                <option value="kosong">Kosong (Tersedia)</option>
                <option value="reservasi">Reservasi (Booking)</option>
                <option value="terisi">Terisi</option>
            </select>
        </div>

        <div class="pt-4 flex gap-3">
            <button type="submit" class="flex-1 bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-black transition shadow-lg">Simpan</button>
            <a href="{{ route('tables.index') }}" class="flex-1 bg-gray-100 text-gray-600 py-3 rounded-xl font-bold hover:bg-gray-200 transition text-center">Batal</a>
        </div>
    </form>
</div>
@endsection