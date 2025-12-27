<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $menu->name }} - Detail</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-white min-h-screen pb-24 relative">

    <!-- HERO IMAGE -->
    <div class="relative w-full h-[40vh]">
        <!-- Tombol Back Floating -->
        <a href="{{ route('public.index') }}" class="absolute top-4 left-4 z-20 bg-white/90 backdrop-blur rounded-full p-2 shadow-lg active:scale-90 transition">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>

        @if($menu->image)
            <img src="{{ asset('storage/' . $menu->image) }}" class="w-full h-full object-cover" alt="{{ $menu->name }}">
        @else
            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 flex-col">
                <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <span>No Image</span>
            </div>
        @endif

        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
    </div>

    <!-- CONTENT WRAPPER -->
    <div class="-mt-6 relative bg-white rounded-t-3xl px-6 pt-8 pb-4 shadow-[0_-5px_20px_rgba(0,0,0,0.05)]">
        <!-- Kategori & Stok -->
        <div class="flex justify-between items-center mb-2">
            <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                {{ $menu->category->name ?? 'Menu' }}
            </span>
            <span class="text-xs text-gray-500 font-medium">
                Stok: {{ $menu->stock }} Porsi
            </span>
        </div>

        <!-- Judul & Harga -->
        <h1 class="text-2xl font-bold text-gray-900 leading-tight mb-2">{{ $menu->name }}</h1>
        <p class="text-2xl font-bold text-orange-600 mb-6">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>

        <!-- Divider -->
        <div class="h-px w-full bg-gray-100 mb-6"></div>

        <!-- Deskripsi -->
        <div class="mb-8">
            <h3 class="text-sm font-bold text-gray-900 mb-2">Deskripsi Menu</h3>
            <p class="text-gray-600 text-sm leading-relaxed">
                {{ $menu->description ?? 'Belum ada deskripsi untuk menu ini.' }}
            </p>
        </div>
    </div>

    <!-- BOTTOM ACTION BAR -->
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-100 p-4 shadow-2xl z-50">
        <div class="max-w-md mx-auto flex gap-3">
            @php
                $waNumber = "6285739519144";
                $waMessage = "Halo, saya ingin memesan menu: " . $menu->name . " seharga Rp " . number_format($menu->price, 0, ',', '.');
                $waLink = "https://wa.me/" . $waNumber . "?text=" . urlencode($waMessage);
            @endphp

            <a href="{{ $waLink }}" target="_blank" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-green-200 transition active:scale-95 flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                Pesan via WA
            </a>

            <!--
            <button class="bg-orange-600 text-white font-bold p-3.5 rounded-xl shadow-lg active:scale-95">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </button>
            -->
        </div>
    </div>

</body>
</html>