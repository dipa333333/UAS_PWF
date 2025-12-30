@extends('layouts.app')

@section('title', 'Kotak Masuk Saran')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow rounded-xl overflow-hidden">

    <div class="px-6 py-4 border-b flex items-center justify-between">
        <h3 class="text-lg font-bold text-gray-800">
            📩 Kritik & Saran Pelanggan
        </h3>
        <span class="text-sm text-gray-500">
            Total: {{ $feedbacks->total() }}
        </span>
    </div>

    <div class="divide-y">
        @forelse($feedbacks as $fb)
        <div class="group p-5 hover:bg-gray-50 transition flex gap-4">

            {{-- Avatar --}}
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold uppercase">
                    {{ substr($fb->customer_name, 0, 1) }}
                </div>
            </div>

            {{-- Content --}}
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900">
                            {{ $fb->customer_name }}
                        </h4>
                        <p class="text-xs text-gray-500">
                            {{ $fb->customer_phone ?? 'Tanpa No HP' }}
                            • {{ $fb->created_at->diffForHumans() }}
                        </p>
                    </div>

                    {{-- Delete --}}
                    <form
                        action="{{ route('feedbacks.destroy', $fb->id) }}"
                        method="POST"
                        onsubmit="return confirm('Hapus pesan ini?')"
                        class="opacity-0 group-hover:opacity-100 transition"
                    >
                        @csrf
                        @method('DELETE')
                        <button class="text-red-400 hover:text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Message bubble --}}
                <div class="mt-2 bg-gray-100 rounded-lg px-4 py-3 text-gray-700 text-sm leading-relaxed italic">
                    “{{ $fb->message }}”
                </div>
            </div>
        </div>
        @empty
        <div class="p-12 text-center text-gray-500">
            <div class="text-4xl mb-2">📭</div>
            <p class="font-medium">Belum ada pesan masuk</p>
            <p class="text-sm text-gray-400">Masukan dari pelanggan akan tampil di sini</p>
        </div>
        @endforelse
    </div>

    <div class="p-4 bg-gray-50">
        {{ $feedbacks->links('partials.pagination') }}
    </div>
</div>
@endsection
