<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Resto Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { fontFamily: { sans: ['Plus Jakarta Sans', 'sans-serif'] } } }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
        .dark .glass-nav { background: rgba(15, 23, 42, 0.8); }
        .hide-scroll::-webkit-scrollbar { display: none; }
        .hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-slate-900 text-slate-800 dark:text-white transition-colors duration-300">

    <div class="fixed top-0 inset-x-0 z-40 glass-nav border-b border-gray-200 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ url('menu-digital') }}" class="p-2 -ml-2 rounded-full hover:bg-gray-100 dark:hover:bg-slate-700 transition group">
                    <svg class="group-hover:-translate-x-1 transition-transform" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>
                <span class="font-bold text-xl tracking-tight">Profile Resto</span>
            </div>

            <a href="https://maps.app.goo.gl/nq2vhGMY4B8cLZvp8" target="_blank" class="hidden md:flex items-center gap-2 text-sm font-medium text-slate-500 hover:text-orange-500 transition">
                <span>📍 Lokasi</span>
            </a>
        </div>
    </div>

    <div x-data="{
            show: false,
            counts: [
                { label: 'Berdiri', target: 2023, current: 0, suffix: '' },
                { label: 'Pelanggan', target: 10, current: 0, suffix: 'k+' },
                { label: 'Rating', target: 5, current: 0, suffix: '.0' }
            ],
            startCounter() {
                this.counts.forEach(c => {
                    let start = 0;
                    let end = c.target;
                    let duration = 2000; // 2 detik
                    let range = end - start;
                    let increment = end > start ? 1 : -1;
                    let stepTime = Math.abs(Math.floor(duration / range));

                    // Khusus tahun berdiri agar tidak terlalu lama
                    if(c.label === 'Berdiri') {
                        c.current = 2023;
                        return;
                    }

                    let timer = setInterval(() => {
                        start += increment;
                        c.current = start;
                        if (start == end) clearInterval(timer);
                    }, stepTime);
                });
            }
         }"
         x-init="setTimeout(() => { show = true; startCounter(); }, 100)"
         class="pt-24 pb-12 max-w-5xl mx-auto px-4 transition-all duration-700"
         :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-8'">

        <div class="text-center mb-12 md:mb-16">
            <div class="relative w-32 h-32 md:w-40 md:h-40 mx-auto mb-6">
                <div class="absolute inset-0 bg-gradient-to-tr from-orange-400 to-red-500 rounded-full blur-2xl opacity-60 animate-pulse"></div>
                <div class="relative w-full h-full bg-white dark:bg-slate-800 rounded-full flex items-center justify-center text-6xl shadow-2xl border-4 border-white dark:border-slate-700">
                    👨‍🍳
                </div>
            </div>

            <h1 class="text-4xl md:text-5xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-orange-600 to-red-600 dark:from-orange-400 dark:to-red-400 mb-4">
                Resto Digital
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-base md:text-lg font-medium max-w-2xl mx-auto">
                Menghadirkan cita rasa bintang lima dengan harga kaki lima. <br class="hidden md:block"> Nikmati pengalaman kuliner modern tanpa antre.
            </p>
        </div>

        <div class="grid grid-cols-3 gap-4 md:gap-8 mb-16 max-w-3xl mx-auto">
            <template x-for="c in counts">
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 text-center hover:-translate-y-1 transition duration-300">
                    <div class="text-3xl md:text-4xl font-bold text-orange-500 mb-1">
                        <span x-text="c.current"></span><span x-text="c.suffix"></span>
                    </div>
                    <div class="text-[10px] md:text-xs text-slate-400 uppercase tracking-widest font-bold" x-text="c.label"></div>
                </div>
            </template>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-16">
            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 h-full">
                <h2 class="text-xl font-bold flex items-center gap-3 mb-6">
                    <span class="bg-orange-100 dark:bg-orange-900/30 text-orange-600 p-2 rounded-xl">🚀</span>
                    Cerita Kami
                </h2>
                <div class="space-y-4 text-slate-600 dark:text-slate-300 leading-relaxed text-sm md:text-base text-justify">
                    <p>
                        Dimulai dari sebuah garasi kecil pada tahun 2023, <strong>Resto Digital</strong> tumbuh menjadi tempat favorit warga lokal. Kami melihat banyak orang kehabisan waktu istirahat hanya karena mengantre makanan.
                    </p>
                    <p>
                        Oleh karena itu, kami menggabungkan teknologi pemesanan digital dengan keahlian memasak tradisional. Hasilnya? Makanan enak yang datang cepat, tanpa drama antrean.
                    </p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 p-6 md:p-8 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 h-full flex flex-col justify-center">
                <h2 class="text-xl font-bold flex items-center gap-3 mb-6">
                    <span class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 p-2 rounded-xl">💎</span>
                    Kenapa Kami?
                </h2>
                <ul class="space-y-5">
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-sm flex-shrink-0">✓</div>
                        <div>
                            <strong class="block text-slate-800 dark:text-white mb-1 text-sm md:text-base">Bahan Segar Harian</strong>
                            <span class="text-xs md:text-sm text-slate-500 dark:text-slate-400">Kami belanja langsung ke petani lokal setiap subuh.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-sm flex-shrink-0">✓</div>
                        <div>
                            <strong class="block text-slate-800 dark:text-white mb-1 text-sm md:text-base">Tanpa MSG Berlebih</strong>
                            <span class="text-xs md:text-sm text-slate-500 dark:text-slate-400">Rasa gurih alami dari racikan rempah rahasia.</span>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <div class="mt-1 w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-sm flex-shrink-0">✓</div>
                        <div>
                            <strong class="block text-slate-800 dark:text-white mb-1 text-sm md:text-base">WiFi Super Ngebut</strong>
                            <span class="text-xs md:text-sm text-slate-500 dark:text-slate-400">Tempat paling nyaman buat WFC atau nugas.</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mb-16 px-2">
            <h2 class="font-bold text-2xl mb-8 text-center">Suasana Resto</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <div class="aspect-square rounded-2xl bg-slate-200 overflow-hidden shadow-sm group">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&q=80" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="aspect-square rounded-2xl bg-slate-200 overflow-hidden shadow-sm group">
                    <img src="https://images.unsplash.com/photo-1552566626-52f8b828add9?auto=format&fit=crop&q=80" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
                <div class="aspect-square rounded-2xl bg-slate-200 overflow-hidden shadow-sm group">
                    <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&q=80" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                </div>
            </div>
        </div>

        <div class="mb-16">
            <h2 class="font-bold text-xl mb-6 px-2 md:text-center">Tim Inti Dibalik Layar</h2>
            <div class="flex md:grid md:grid-cols-4 gap-4 overflow-x-auto hide-scroll px-2 md:px-0 pb-4">
                <div class="flex-shrink-0 w-36 md:w-auto bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 text-center shadow-sm hover:shadow-md transition">
                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random&size=128" class="w-20 h-20 rounded-full mx-auto mb-3 shadow-md">
                    <h3 class="font-bold text-slate-800 dark:text-white text-sm md:text-base">Budi Santoso</h3>
                    <p class="text-[10px] md:text-xs text-slate-500 mt-1">Head Chef</p>
                </div>
                <div class="flex-shrink-0 w-36 md:w-auto bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 text-center shadow-sm hover:shadow-md transition">
                    <img src="https://ui-avatars.com/api/?name=Agung+Dipa&background=random&size=128" class="w-20 h-20 rounded-full mx-auto mb-3 shadow-md">
                    <h3 class="font-bold text-slate-800 dark:text-white text-sm md:text-base">Agung Dipa</h3>
                    <p class="text-[10px] md:text-xs text-slate-500 mt-1">Manager</p>
                </div>
                <div class="flex-shrink-0 w-36 md:w-auto bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 text-center shadow-sm hover:shadow-md transition">
                    <img src="https://ui-avatars.com/api/?name=Riko+Pratama&background=random&size=128" class="w-20 h-20 rounded-full mx-auto mb-3 shadow-md">
                    <h3 class="font-bold text-slate-800 dark:text-white text-sm md:text-base">Riko Pratama</h3>
                    <p class="text-[10px] md:text-xs text-slate-500 mt-1">Barista</p>
                </div>
                <div class="flex-shrink-0 w-36 md:w-auto bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-100 dark:border-slate-700 text-center shadow-sm hover:shadow-md transition">
                    <img src="https://ui-avatars.com/api/?name=Dewi+Sartika&background=random&size=128" class="w-20 h-20 rounded-full mx-auto mb-3 shadow-md">
                    <h3 class="font-bold text-slate-800 dark:text-white text-sm md:text-base">Dewi Sartika</h3>
                    <p class="text-[10px] md:text-xs text-slate-500 mt-1">Marketing</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-slate-800 to-slate-950 rounded-3xl p-8 md:p-12 text-white shadow-2xl relative overflow-hidden text-center md:text-left">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-5 rounded-full blur-3xl"></div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-8 relative z-10">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Yuk, Mampir Sekarang!</h2>
                    <p class="text-slate-400 text-sm md:text-base">Kami tunggu kedatanganmu di outlet kami.</p>

                    <div class="flex flex-col md:flex-row gap-4 md:gap-8 mt-6 text-sm font-light">
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="opacity-70">📍</span>
                            <span>Jl. Makanan Enak No. 123, Jaksel</span>
                        </div>
                        <div class="flex items-center justify-center md:justify-start gap-2">
                            <span class="opacity-70">⏰</span>
                            <span>Buka Tiap Hari (10:00 - 22:00)</span>
                        </div>
                    </div>
                </div>

                <a href="https://maps.app.goo.gl/nq2vhGMY4B8cLZvp8" target="_blank" class="w-full md:w-auto bg-white text-slate-900 hover:bg-orange-50 px-8 py-3 rounded-xl transition font-bold shadow-lg flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="3 11 22 2 13 21 11 13 3 11"></polygon></svg>
                    Petunjuk Arah
                </a>
            </div>
        </div>

        <div class="text-center text-xs text-slate-400 mt-12">
            &copy; {{ date('Y') }} Resto Digital. All rights reserved.
        </div>
    </div>
</body>
</html>