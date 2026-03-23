@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $window = 2; // pages shown on each side of current

        $pages = [];
        for ($i = 1; $i <= $lastPage; $i++) {
            if (
                $i === 1 ||
                $i === $lastPage ||
                abs($i - $currentPage) <= $window
            ) {
                $pages[] = $i;
            }
        }

        // Insert null for gaps
        $withGaps = [];
        $prev = null;
        foreach ($pages as $page) {
            if ($prev !== null && $page - $prev > 1) {
                $withGaps[] = null; // gap
            }
            $withGaps[] = $page;
            $prev = $page;
        }
    @endphp

    <div class="flex items-center justify-between gap-2">
        {{-- Info --}}
        <span class="text-xs text-gray-500 dark:text-gray-400 shrink-0">
            {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} / {{ $paginator->total() }}
        </span>

        {{-- Page buttons --}}
        <div class="flex items-center gap-1">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-md text-gray-300 dark:text-gray-600 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <button wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            @endif

            {{-- Page numbers --}}
            @foreach ($withGaps as $page)
                @if ($page === null)
                    <span class="inline-flex items-center justify-center w-8 h-8 text-xs text-gray-400">…</span>
                @elseif ($page === $currentPage)
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-md bg-primary-600 text-white text-xs font-semibold">
                        {{ $page }}
                    </span>
                @else
                    <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                        class="inline-flex items-center justify-center w-8 h-8 rounded-md border border-gray-300 bg-white text-gray-600 text-xs hover:bg-gray-50 hover:text-gray-900 transition-colors dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                        {{ $page }}
                    </button>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled"
                    class="inline-flex items-center justify-center w-8 h-8 rounded-md border border-gray-300 bg-white text-gray-500 hover:bg-gray-50 hover:text-gray-700 transition-colors dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @else
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-md text-gray-300 dark:text-gray-600 cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </div>
    </div>
@endif
