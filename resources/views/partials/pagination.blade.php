@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">

        {{-- Tombol Previous --}}
        <div class="flex-1 flex justify-start">
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 text-sm text-slate-400 bg-slate-100 rounded-lg cursor-not-allowed">
                    &laquo; Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                   class="px-3 py-1 text-sm text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition">
                    &laquo; Prev
                </a>
            @endif
        </div>

        {{-- Angka Halaman --}}
        <div class="hidden sm:flex items-center gap-1">
            @foreach ($elements as $element)
                {{-- Separator (...) --}}
                @if (is_string($element))
                    <span class="px-2 text-slate-400">{{ $element }}</span>
                @endif

                {{-- Array Link --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1 text-sm font-bold text-white bg-orange-500 rounded-lg shadow-sm">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                               class="px-3 py-1 text-sm text-slate-600 hover:bg-orange-50 hover:text-orange-600 rounded-lg transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Tombol Next --}}
        <div class="flex-1 flex justify-end">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                   class="px-3 py-1 text-sm text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition">
                    Next &raquo;
                </a>
            @else
                <span class="px-3 py-1 text-sm text-slate-400 bg-slate-100 rounded-lg cursor-not-allowed">
                    Next &raquo;
                </span>
            @endif
        </div>
    </nav>
@endif