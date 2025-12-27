@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <h2 class="text-2xl font-bold text-gray-800">Dashboard Overview</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 flex items-center border-l-4 border-blue-500 relative overflow-hidden">
            <div class="p-3 bg-blue-100 rounded-full mr-4 text-blue-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-semibold">Total Menu</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalMenus }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 flex items-center border-l-4 border-green-500 relative overflow-hidden">
            <div class="p-3 bg-green-100 rounded-full mr-4 text-green-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-semibold">Menu Tersedia (Stok Aman)</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $availableMenus }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 flex items-center border-l-4 border-red-500 relative overflow-hidden">
            <div class="p-3 bg-red-100 rounded-full mr-4 text-red-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-semibold">Stok Habis (Perlu Restock)</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $soldOutMenus }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Statistik Menu per Kategori</h3>
            <div class="relative h-64">
                @if($totalMenus > 0)
                    <canvas id="categoryChart"></canvas>
                @else
                    <div class="flex items-center justify-center h-full text-gray-400">
                        Belum ada data menu
                    </div>
                @endif
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm">
            <h3 class="text-lg font-bold text-gray-700 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                Perlu Perhatian (Stok < 5)
            </h3>

            <div class="overflow-y-auto max-h-60">
                @forelse($lowStockMenus as $item)
                    <div class="flex justify-between items-center border-b py-3 last:border-0 hover:bg-gray-50 px-2 rounded transition">
                        <div class="flex items-center gap-3">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-10 h-10 rounded-md object-cover">
                            @else
                                <div class="w-10 h-10 rounded-md bg-gray-200"></div>
                            @endif
                            <div>
                                <p class="font-bold text-gray-800 text-sm">{{ $item->name }}</p>
                                <p class="text-xs text-gray-500">{{ $item->category->name }}</p>
                            </div>
                        </div>
                        <span class="bg-orange-100 text-orange-700 text-xs font-bold px-3 py-1 rounded-full">
                            Sisa: {{ $item->stock }}
                        </span>
                    </div>
                @empty
                    <div class="text-center py-8 text-gray-400 text-sm">
                        <p>Aman! Tidak ada stok yang menipis.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    @if($totalMenus > 0)
    const ctx = document.getElementById('categoryChart').getContext('2d');
    const labels = @json($chartLabels);
    const dataValues = @json($chartData);

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Menu',
                data: dataValues,
                backgroundColor: [
                    '#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899', '#6366F1'
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: { boxWidth: 12, font: { size: 11 } }
                }
            }
        }
    });
    @endif
</script>
@endsection