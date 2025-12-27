<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resto Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-scroll::-webkit-scrollbar { width: 5px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: #1f2937; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: #374151; border-radius: 5px; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden text-gray-800" x-data="{ sidebarOpen: false }">

    <!-- OVERLAY (Mobile) -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
         class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden"></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 text-white flex flex-col shadow-2xl transition-transform duration-300 lg:translate-x-0 lg:static">

        <div class="h-16 flex items-center justify-center border-b border-gray-800 bg-gray-900">
            <h1 class="text-2xl font-bold tracking-wider">
                <span class="text-orange-500">RESTO</span>APP
            </h1>
        </div>

        <nav class="flex-1 overflow-y-auto py-4 sidebar-scroll">
            <ul class="space-y-1 px-3">
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        Dashboard
                    </a>
                </li>

                <li class="px-4 mt-6 mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Manajemen
                </li>

                <li>
                    <a href="{{ route('menus.index') }}"
                       class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('menus.*') ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        Daftar Menu
                    </a>
                </li>

                <li>
                    <a href="{{ route('categories.index') }}"
                       class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('categories.*') ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        Kategori
                    </a>
                </li>

                <li>
                    <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('orders.*') ? 'bg-orange-600 text-white shadow-lg shadow-orange-900/20' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        <span class="font-medium">Daftar Pesanan</span>
                        <span class="ml-auto bg-blue-500 text-white text-[10px] px-1.5 py-0.5 rounded font-bold">New</span>
                    </a>
                </li>

                <!-- FEEDBACK/INBOX -->
                <li>
                    <a href="{{ route('feedbacks.index') }}"
                       class="flex items-center px-4 py-3 rounded-lg transition-colors {{ request()->routeIs('feedbacks.*') ? 'bg-orange-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                       <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Kotak Masuk
                    </a>
                </li>

                <li class="px-4 mt-6 mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    Lainnya
                </li>

                <li>
                    <a href="{{ route('public.index') }}" target="_blank"
                       class="flex items-center px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 00-2 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        Lihat Website
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 border-t border-gray-800 bg-gray-900">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-orange-500 flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-500">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="bg-white shadow-sm border-b border-gray-200 h-16 flex items-center justify-between px-6 z-10">
            <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <h2 class="text-xl font-bold text-gray-800 hidden sm:block">
                @yield('title')
            </h2>
            <div class="flex items-center gap-4">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 focus:outline-none">
                        <span>Akun Saya</span>
                        <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-cloak
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 z-50">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Edit Profil</a>
                        <div class="border-t border-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center">
                    <div>
                        <p class="font-bold">Berhasil!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                    <p class="font-bold">Terjadi Kesalahan</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>