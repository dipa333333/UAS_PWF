@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Meja</h2>

        <!-- Tombol Hapus -->
        <form action="{{ route('tables.destroy', $table->id) }}" method="POST" onsubmit="return confirm('Hapus meja ini permanen?');">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 hover:bg-red-50 p-2 rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </form>
    </div>

    <form action="{{ route('tables.update', $table->id) }}" method="POST" class="space-y-5">
        @csrf @method('PUT')

        <div>
            <label class="block mb-2 font-bold text-sm text-gray-700">Nama Meja</label>
            <input type="text" name="name" value="{{ $table->name }}" class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required>
        </div>

        <div>
            <label class="block mb-2 font-bold text-sm text-gray-700">Kapasitas</label>
            <input type="number" name="capacity" value="{{ $table->capacity }}" class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none" required min="1">
        </div>

        <div>
            <label class="block mb-2 font-bold text-sm text-gray-700">Status</label>
            <select name="status" class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="kosong" {{ $table->status == 'kosong' ? 'selected' : '' }}>Kosong</option>
                <option value="reservasi" {{ $table->status == 'reservasi' ? 'selected' : '' }}>Reservasi</option>
                <option value="terisi" {{ $table->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
            </select>
        </div>

        <div class="pt-4 flex gap-3">
            <button type="submit" class="flex-1 bg-gray-900 text-white py-3 rounded-xl font-bold hover:bg-black transition shadow-lg">Update</button>
            <a href="{{ route('tables.index') }}" class="flex-1 bg-gray-100 text-gray-600 py-3 rounded-xl font-bold hover:bg-gray-200 transition text-center">Batal</a>
        </div>
    </form>
</div>
@endsection