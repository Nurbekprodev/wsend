@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">

    {{-- Mobile --}}
    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 
            bg-white border border-gray-300 rounded-lg cursor-not-allowed 
            dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 
            bg-white border border-gray-300 rounded-lg 
            hover:bg-gray-100 hover:text-primary-700
            focus:ring-2 focus:ring-primary-300
            dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 
            dark:hover:bg-gray-700">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 
            bg-white border border-gray-300 rounded-lg 
            hover:bg-gray-100 hover:text-primary-700
            focus:ring-2 focus:ring-primary-300
            dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 
            dark:hover:bg-gray-700">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 
            bg-white border border-gray-300 rounded-lg cursor-not-allowed
            dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </div>

    {{-- Desktop --}}
    <div class="hidden sm:flex-1 sm:flex sm:flex-col sm:items-center sm:justify-center gap-3">

        <div>
            <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                Showing
                @if ($paginator->firstItem())
                    <span class="font-medium">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                of
                <span class="font-medium">{{ $paginator->total() }}</span>
                results
            </p>
        </div>

        <div class="flex justify-center w-full">
            <span class="inline-flex -space-x-px rounded-md shadow-sm">

                {{-- Previous --}}
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 
                    rounded-l-lg cursor-not-allowed 
                    dark:bg-gray-800 dark:border-gray-600">
                        ‹
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="px-3 py-2 text-gray-500 bg-white border border-gray-300 
                    rounded-l-lg hover:bg-gray-100 hover:text-primary-700
                    focus:outline-none focus:ring-2 focus:ring-primary-300 ring-inset
                    dark:bg-gray-800 dark:border-gray-600 
                    dark:text-gray-300 dark:hover:bg-gray-700">
                        ‹
                    </a>
                @endif

                {{-- Pages --}}
                @foreach ($elements as $element)

                    {{-- dots --}}
                    @if (is_string($element))
                        <span class="px-4 py-2 text-gray-500 bg-white border border-gray-300 
                        dark:bg-gray-800 dark:border-gray-600">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())

                                <span class="px-4 py-2 text-white border border-primary-700 
                                bg-primary-700 dark:bg-primary-600 dark:border-primary-600">
                                    {{ $page }}
                                </span>

                            @else

                                <a href="{{ $url }}"
                                class="px-4 py-2 text-gray-700 bg-white border border-gray-300 
                                hover:bg-gray-100 hover:text-primary-700
                                focus:outline-none focus:ring-2 focus:ring-primary-300 ring-inset
                                dark:bg-gray-800 dark:border-gray-600 
                                dark:text-gray-300 dark:hover:bg-gray-700">
                                    {{ $page }}
                                </a>

                            @endif
                        @endforeach
                    @endif

                @endforeach

                {{-- Next --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="px-3 py-2 text-gray-500 bg-white border border-gray-300 
                    rounded-r-lg hover:bg-gray-100 hover:text-primary-700
                    focus:outline-none focus:ring-2 focus:ring-primary-300 ring-inset
                    dark:bg-gray-800 dark:border-gray-600 
                    dark:text-gray-300 dark:hover:bg-gray-700">
                        ›
                    </a>
                @else
                    <span class="px-3 py-2 text-gray-400 bg-white border border-gray-300 
                    rounded-r-lg cursor-not-allowed
                    dark:bg-gray-800 dark:border-gray-600">
                        ›
                    </span>
                @endif

            </span>
        </div>
    </div>

</nav>
@endif