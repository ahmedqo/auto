@if ($paginator->hasPages())
    <nav class="w-full container mx-auto flex items-center justify-center gap-2 mt-4">
        @if (!$paginator->onFirstPage())
            <a id="prev" slot="end" title="{{ __('Prev') }}" href="{{ $paginator->previousPageUrl() }}"
                aria-label="prev_page_link"
                class="flex items-center justify-center w-8 h-8 rounded-full outline-none border border-x-shade shadow-x-core bg-x-white hover:bg-x-prime hover:text-x-white focus:bg-x-prime focus:text-x-white">
                <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                    <path
                        d="M452-219 190-481l262-262 64 64-199 198 199 197-64 65Zm257 0L447-481l262-262 63 64-198 198 198 197-63 65Z" />
                </svg>
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a id="next" slot="end" title="{{ __('Next') }}" href="{{ $paginator->nextPageUrl() }}"
                aria-label="next_page_link"
                class="flex items-center justify-center w-8 h-8 rounded-full outline-none border border-x-shade shadow-x-core bg-x-white hover:bg-x-prime hover:text-x-white focus:bg-x-prime focus:text-x-white">
                <svg class="block w-5 h-5 pointer-events-none" fill="currentcolor" viewBox="0 -960 960 960">
                    <path
                        d="M388-481 190-679l64-64 262 262-262 262-64-65 198-197Zm257 0L447-679l63-64 262 262-262 262-63-65 198-197Z" />
                </svg>
            </a>
        @endif
    </nav>
@endif
