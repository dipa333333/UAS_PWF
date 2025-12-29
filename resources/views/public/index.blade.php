<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Menu Resto Digital</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-tap-highlight-color: transparent; }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-gray-50 pb-32">
<div x-data="shop()" x-init="initCart()">

    <!-- NOTIFIKASI SUKSES (POPUP ATAS) -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-4 left-4 right-4 z-[60] bg-green-500 text-white px-6 py-4 rounded-xl shadow-xl flex items-center justify-between animate-bounce">
            <span class="font-bold text-sm">{{ session('success') }}</span>
            <button @click="show = false">&times;</button>
        </div>
    @endif

    <!-- 1. HEADER (Sticky & Glassmorphism) -->
    <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-md shadow-[0_1px_10px_rgba(0,0,0,0.05)] border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between py-3 md:py-4 gap-4">

                <!-- Logo & Tombol Mobile -->
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Selamat Datang</p>
                        <h1 class="text-2xl font-extrabold text-gray-800 tracking-tight">Resto<span class="text-orange-600">App</span></h1>
                    </div>

                    <!-- Tombol Reservasi (Mobile) - FITUR BARU -->
                    <button
                        type="button"
                        @click.prevent="openReservation = true"
                        class="md:hidden bg-gray-900 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow-lg shadow-gray-300 active:scale-95 transition">
                        Reservasi
                    </button>

                </div>

                <!-- Search & Actions -->
                <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto md:flex-1 md:justify-end md:items-center">
                    <!-- Search Bar -->
                    <div class="w-full md:max-w-md">
                        <form action="{{ route('public.index') }}" method="GET" class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400 group-focus-within:text-orange-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="block w-full pl-11 pr-4 py-2.5 bg-gray-100 border-none rounded-xl text-sm font-medium text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-orange-500 focus:bg-white transition-all shadow-inner"
                                   placeholder="Cari menu favorit...">
                        </form>
                    </div>

                    <!-- Tombol Desktop (Reservasi & Admin) -->
                    <div class="hidden md:flex gap-2">
                        <!-- Tombol Reservasi Desktop - FITUR BARU -->
                        <button
                            type="button"
                            @click.prevent="openReservation = true"
                            class="px-4 py-2.5 bg-orange-500 text-white rounded-xl text-sm font-bold hover:bg-orange-600 transition shadow-lg shadow-orange-200">
                            Reservasi Meja
                        </button>


                        <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2.5 bg-gray-900 text-white rounded-xl text-sm font-bold hover:bg-gray-800 transition shadow-lg shadow-gray-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Admin
                        </a>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="flex overflow-x-auto gap-2 pb-3 pt-1 hide-scroll md:pb-4 border-t border-gray-100 md:border-none mt-2 md:mt-0">
                <a href="{{ route('public.index') }}"
                   class="whitespace-nowrap px-4 py-1.5 md:px-5 md:py-2 rounded-full text-xs md:text-sm font-bold transition-all transform hover:scale-105 active:scale-95 shadow-sm
                   {{ !request('category') ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-orange-200' : 'bg-white text-gray-600 border border-gray-200 hover:border-orange-300 hover:text-orange-600' }}">
                   🔥 Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('public.index', ['category' => $cat->name]) }}"
                       class="whitespace-nowrap px-4 py-1.5 md:px-5 md:py-2 rounded-full text-xs md:text-sm font-bold transition-all transform hover:scale-105 active:scale-95 shadow-sm
                       {{ request('category') == $cat->name ? 'bg-gradient-to-r from-orange-600 to-orange-500 text-white shadow-orange-200' : 'bg-white text-gray-600 border border-gray-200 hover:border-orange-300 hover:text-orange-600' }}">
                       {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <!-- 2. PROMO BANNER (ANIMASI KETIK DIKEMBALIKAN) -->
        @if(!request('search') && !request('category'))
        <div class="mb-8 bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-6 md:p-10 text-white shadow-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mt-8 -mr-8 w-48 h-48 bg-orange-500 rounded-full opacity-20 blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
            <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-blue-500 rounded-full opacity-20 blur-3xl group-hover:scale-125 transition-transform duration-700"></div>

            <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div x-data="{
                    text: '',
                    words: ['Lapar?', 'Haus?', 'Nyari Promo?', 'Pengen Ngemil?', 'Mager Masak?'],
                    wordIndex: 0,
                    isDeleting: false,
                    type() {
                        const currentWord = this.words[this.wordIndex];
                        if(this.isDeleting) {
                            this.text = currentWord.substring(0, this.text.length - 1);
                        } else {
                            this.text = currentWord.substring(0, this.text.length + 1);
                        }
                        let typeSpeed = 100;
                        if(this.isDeleting) typeSpeed /= 2;
                        if(!this.isDeleting && this.text === currentWord) {
                            typeSpeed = 2000;
                            this.isDeleting = true;
                        } else if(this.isDeleting && this.text === '') {
                            this.isDeleting = false;
                            this.wordIndex = (this.wordIndex + 1) % this.words.length;
                            typeSpeed = 500;
                        }
                        setTimeout(() => this.type(), typeSpeed);
                    }
                }" x-init="type()">
                    <h2 class="text-2xl md:text-4xl font-extrabold mb-2 leading-tight h-16 md:h-auto flex flex-col justify-center">
                        <span class="block">
                            <span x-text="text"></span><span class="animate-pulse text-orange-500">😋|</span>
                        </span>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-yellow-400">Pesan Sekarang!</span> 
                    </h2>
                    <p class="text-gray-300 text-sm md:text-base max-w-lg mt-2">Nikmati hidangan spesial chef kami. Pesan langsung dari sini, pesanan otomatis terhubung ke WhatsApp.</p>
                </div>

                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-lg border border-white/10">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-sm font-bold">Buka: 09:00 - 22:00</span>
                </div>
            </div>
        </div>
        @endif

        <!-- 3. MENU GRID (FLY TO CART DIKEMBALIKAN) -->
        @if(request('search'))
            <p class="mb-6 text-lg font-semibold text-gray-500">Hasil pencarian untuk: <span class="text-gray-900 font-bold">"{{ request('search') }}"</span></p>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6 lg:gap-8">
            @forelse($menus as $menu)
                @php
                    $finalPrice = $menu->discount_price ?? $menu->price;
                    $isPromo = $menu->discount_price && $menu->discount_price < $menu->price;
                    $discountPercent = $isPromo ? round((($menu->price - $menu->discount_price) / $menu->price) * 100) : 0;
                @endphp

                <div class="group bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)] hover:shadow-[0_10px_30px_rgba(0,0,0,0.1)] transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col h-full relative transform hover:-translate-y-1">

                    <a href="{{ route('public.show', $menu->id) }}" class="block relative flex-shrink-0">
                        @if($isPromo)
                            <div class="absolute top-3 left-0 bg-red-600 text-white text-[10px] md:text-xs font-bold px-3 py-1 rounded-r-full shadow-md z-10">
                                HEMAT {{ $discountPercent }}%
                            </div>
                        @endif

                        <div class="w-full aspect-square overflow-hidden bg-gray-50">
                            @if($menu->image)
                                <img src="{{ asset('storage/' . $menu->image) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                    <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-xs font-medium">No Image</span>
                                </div>
                            @endif

                            @if($menu->stock > 0 && $menu->stock < 5)
                                <div class="absolute bottom-2 right-2 bg-orange-100/90 backdrop-blur text-orange-700 text-[10px] px-2 py-0.5 rounded border border-orange-200 font-bold">
                                    Sisa {{ $menu->stock }}
                                </div>
                            @endif
                        </div>
                    </a>

                    <div class="p-4 flex flex-col flex-1">
                        <div class="mb-2">
                            <span class="text-[10px] md:text-xs font-bold uppercase tracking-wider text-orange-600 bg-orange-50 px-2 py-1 rounded-md">
                                {{ $menu->category->name }}
                            </span>
                        </div>

                        <a href="{{ route('public.show', $menu->id) }}" class="block mb-3">
                            <h3 class="font-bold text-gray-800 text-sm md:text-base leading-snug line-clamp-2 group-hover:text-orange-600 transition-colors">
                                {{ $menu->name }}
                            </h3>
                        </a>

                        <div class="mt-auto pt-3 border-t border-dashed border-gray-100 flex items-end justify-between gap-2">
                            <div class="flex flex-col">
                                @if($isPromo)
                                    <span class="text-[10px] md:text-xs text-gray-400 line-through decoration-red-400">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                    <span class="text-sm md:text-lg font-extrabold text-red-600">Rp {{ number_format($finalPrice / 1000, 0) }}k</span>
                                @else
                                    <span class="text-sm md:text-lg font-extrabold text-gray-900">Rp {{ number_format($finalPrice / 1000, 0) }}k</span>
                                @endif
                            </div>

                            @if($menu->stock > 0)
                                <button @click="addToCart({{ $menu->id }}, '{{ addslashes($menu->name) }}', {{ $finalPrice }}, '{{ $menu->image }}', $event)"
                                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-gray-900 text-white flex items-center justify-center hover:bg-orange-600 transition-all transform active:scale-90 hover:shadow-lg">
                                    <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                </button>
                            @else
                                <span class="text-[10px] md:text-xs font-bold text-gray-400 bg-gray-100 px-2 py-1 rounded select-none">Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Menu tidak ditemukan</h3>
                    <a href="{{ route('public.index') }}" class="mt-4 text-orange-600 text-sm font-bold hover:underline">Lihat Semua Menu</a>
                </div>
            @endforelse
        </div>

        <!-- 4. FEEDBACK SECTION (DIKEMBALIKAN) -->
        <div class="mt-16 pt-10 border-t border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                <div class="md:pr-10">
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-2">Punya Saran? 💬</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        Kami selalu berusaha memberikan pelayanan terbaik. Masukan Anda sangat berarti bagi kami.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-6 md:p-8 shadow-xl shadow-gray-200/50 border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-50 to-transparent rounded-bl-full -mr-10 -mt-10 pointer-events-none"></div>

                    <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4 relative z-10">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5 ml-1">Nama</label>
                                <input type="text" name="customer_name" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition" required>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5 ml-1">No. HP</label>
                                <input type="text" name="customer_phone" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-1.5 ml-1">Pesan Anda</label>
                            <textarea name="message" rows="3" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition" required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gray-900 text-white py-3.5 rounded-xl text-sm font-bold hover:bg-black transition shadow-lg flex justify-center items-center gap-2">
                            <span>Kirim Masukan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <!-- 5. FLOATING CART -->
    <div x-show="cart.length > 0"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         x-cloak
         class="fixed bottom-6 left-0 right-0 z-40 px-4 flex justify-center pointer-events-none">

        <button @click="showModal = true"
                data-cart-icon
                class="pointer-events-auto w-full max-w-sm bg-gray-900/90 backdrop-blur-md text-white p-4 rounded-2xl shadow-2xl shadow-gray-900/30 flex justify-between items-center transform hover:scale-[1.02] active:scale-95 transition-all border border-gray-700/50 cursor-pointer">
            <div class="flex items-center gap-4">
                <div class="relative w-10 h-10 flex items-center justify-center rounded-xl bg-orange-500 shadow-lg shadow-orange-500/40">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.3 5.2A1 1 0 006.7 20h10.6a1 1 0 001-.8L20 13M7 13h10" />
                    </svg>
                    <span x-show="totalQty() > 0" class="absolute -top-1 -right-1 flex items-center justify-center">
                        <span :class="pulse ? 'animate-ping' : ''" class="absolute inline-flex h-full w-full rounded-full bg-red-500 opacity-75"></span>
                        <span x-text="totalQty()" class="relative bg-red-600 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-gray-900"></span>
                    </span>
                </div>
                <div class="flex flex-col text-left">
                    <span class="text-[10px] text-gray-300 font-medium uppercase tracking-wider">Total Estimasi</span>
                    <span class="font-bold text-lg leading-none" x-text="'Rp ' + formatRupiah(totalPrice())"></span>
                </div>
            </div>
            <div class="flex items-center gap-2 font-bold text-sm bg-white/10 px-3 py-1.5 rounded-lg hover:bg-white/20 transition">
                Lihat
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
            </div>
        </button>
    </div>

    <!-- 6. CART MODAL -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-end justify-center sm:items-center">
        <div @click="showModal = false" class="absolute inset-0 bg-black/60 backdrop-blur-sm cursor-pointer"></div>
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="bg-white w-full max-w-md rounded-t-3xl sm:rounded-3xl p-6 relative z-10 max-h-[85vh] flex flex-col shadow-2xl">

            <div class="flex justify-between items-center mb-6 mt-2 border-b border-gray-100 pb-4">
                <h2 class="text-xl font-bold text-gray-900">Keranjang Pesanan</h2>
                <button @click="showModal = false" class="p-2 bg-gray-100 rounded-full text-gray-500 hover:bg-gray-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="overflow-y-auto flex-1 space-y-4 mb-6 pr-2">
                <template x-for="(item, index) in cart" :key="index">
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl border border-gray-100">
                        <div class="flex items-center gap-3">
                            <img :src="item.image ? '/storage/'+item.image : ''" class="w-12 h-12 rounded bg-gray-200 object-cover flex-shrink-0">
                            <div class="flex flex-col">
                                <span class="font-bold text-sm text-gray-800 line-clamp-1" x-text="item.name"></span>
                                <span class="text-xs text-orange-600 font-bold" x-text="'@ Rp ' + formatRupiah(item.price)"></span>
                            </div>
                        </div>
                        <div class="flex items-center bg-white rounded-lg shadow-sm border border-gray-200 p-1">
                            <button @click="decrease(index)" class="w-7 h-7 rounded text-gray-500 hover:bg-gray-100 font-bold text-lg flex items-center justify-center transition">-</button>
                            <span class="text-sm font-bold w-8 text-center text-gray-800" x-text="item.qty"></span>
                            <button @click="increase(index)" class="w-7 h-7 rounded text-white bg-orange-500 hover:bg-orange-600 font-bold text-lg flex items-center justify-center transition shadow-sm">+</button>
                        </div>
                    </div>
                </template>
                <div x-show="cart.length === 0" class="text-center py-10 text-gray-400 text-sm">Keranjang masih kosong.</div>
            </div>

            <div class="border-t border-gray-100 pt-4 bg-white">
                <div class="flex justify-between items-end mb-4">
                    <span class="text-sm text-gray-500 font-medium">Total Pembayaran</span>
                    <span class="font-extrabold text-2xl text-gray-900" x-text="'Rp ' + formatRupiah(totalPrice())"></span>
                </div>
                <button @click="checkoutWA()" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-green-200 flex justify-center items-center gap-3 transition transform active:scale-[0.98]">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    Pesan via WhatsApp
                </button>
            </div>
        </div>
    </div>

    <!-- MODAL RESERVASI -->
    <div x-show="openReservation"
        x-cloak
        class="fixed inset-0 z-[60] flex items-center justify-center p-4">

        <!-- BACKDROP -->
         <div
            class="absolute inset-0 bg-black/60 backdrop-blur-sm"
            @click="openReservation = false">
         </div>

        <!-- MODAL -->
        <div
            x-show="openReservation"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative bg-white rounded-3xl w-full max-w-md p-6 shadow-2xl">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-extrabold text-gray-800">Reservasi Meja 📅</h2>
                <button
                    type="button"
                    @click="openReservation = false"
                    class="text-gray-400 hover:text-gray-600">
                    ✕
                </button>
            </div>

            <p class="text-gray-500 text-sm mb-6">
                Silakan isi data untuk reservasi. Admin akan menghubungi via WhatsApp.
            </p>

            <form action="{{ route('reservations.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">Nama</label>
                    <input
                        type="text"
                        name="name"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">No WhatsApp</label>
                    <input
                        type="tel"
                        name="phone"
                        placeholder="08123456789"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Jumlah Orang</label>
                        <input
                            type="number"
                            name="pax"
                            min="1"
                            value="2"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1">Waktu</label>
                        <input
                            type="datetime-local"
                            name="reservation_time"
                            min="{{ now()->format('Y-m-d\TH:i') }}"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button
                        type="button"
                        @click="openReservation = false"
                        class="flex-1 bg-gray-100 text-gray-700 py-3 rounded-xl font-bold hover:bg-gray-200 transition">
                        Batal
                    </button>

                    <button
                        type="submit"
                        class="flex-1 bg-orange-600 text-white py-3 rounded-xl font-bold hover:bg-orange-700 shadow-lg shadow-orange-200 transition active:scale-95">
                        Kirim Reservasi
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- JAVASCRIPT LOGIC -->
    <script>
        function shop() {
            return {
                cart: [],
                showModal: false,
                openReservation: false, // State untuk modal reservasi
                pulse: false,
                waNumber: '6285739519144', // GANTI NOMOR WA DISINI

                initCart() {
                    if(localStorage.getItem('restoCart')) {
                        try { this.cart = JSON.parse(localStorage.getItem('restoCart')); }
                        catch(e) { localStorage.removeItem('restoCart'); }
                    }
                },

                saveCart() {
                    localStorage.setItem('restoCart', JSON.stringify(this.cart));
                },

                addToCart(id, name, price, image, event) {
                    let existingItem = this.cart.find(item => item.id === id);

                    if (existingItem) {
                        existingItem.qty++;
                    } else {
                        this.cart.push({ id, name, price, image, qty: 1 });
                    }

                    this.saveCart();

                    this.pulse = true;
                    setTimeout(() => this.pulse = false, 400);

                    if (event && event.currentTarget) {
                        this.flyToCart(event);
                    }
                },

                flyToCart(event) {
                    const button = event.currentTarget;
                    const cartBtn = document.querySelector('[data-cart-icon]');
                    if (!cartBtn) return;

                    const rectFrom = button.getBoundingClientRect();
                    const rectTo = cartBtn.getBoundingClientRect();

                    const fly = document.createElement("div");
                    fly.className = "fixed z-[9999] w-4 h-4 bg-orange-500 rounded-full pointer-events-none";
                    fly.style.left = rectFrom.left + rectFrom.width / 2 + "px";
                    fly.style.top = rectFrom.top + rectFrom.height / 2 + "px";

                    document.body.appendChild(fly);

                    fly.animate([
                        { transform: "translate(0,0) scale(1)", opacity: 1 },
                        { transform: `translate(${rectTo.left - rectFrom.left}px, ${rectTo.top - rectFrom.top}px) scale(0.2)`, opacity: 0 }
                    ], {
                        duration: 600,
                        easing: "cubic-bezier(.4,0,.2,1)"
                    });

                    setTimeout(() => fly.remove(), 600);
                },

                increase(index) {
                    this.cart[index].qty++;
                    this.saveCart();
                },

                decrease(index) {
                    if(this.cart[index].qty > 1) {
                        this.cart[index].qty--;
                    } else {
                        this.cart.splice(index, 1);
                    }
                    this.saveCart();
                },

                totalQty() { return this.cart.reduce((t, i) => t + i.qty, 0); },
                totalPrice() { return this.cart.reduce((t, i) => t + (i.price * i.qty), 0); },
                formatRupiah(n) { return new Intl.NumberFormat('id-ID').format(n); },

                checkoutWA() {
                    if(this.cart.length === 0) return;
                    let message = "Halo Admin, saya mau pesan:\n\n";
                    this.cart.forEach(item => {
                        message += `📦 *${item.name}*\n    ${item.qty}x @ Rp ${this.formatRupiah(item.price)} = Rp ${this.formatRupiah(item.price * item.qty)}\n`;
                    });
                    message += `\n💰 *TOTAL: Rp ${this.formatRupiah(this.totalPrice())}*`;
                    message += `\n\nMohon diproses ya, terima kasih!`;
                    window.open(`https://wa.me/${this.waNumber}?text=${encodeURIComponent(message)}`, '_blank');
                }
            }
        }
    </script>
</div>
</body>
</html>