@if ($paginator->hasPages())
    <nav class="flex justify-center" role="navigation">
        {{-- Previous link --}}
        @if ($paginator->onFirstPage())
            <span class="rounded-l-lg bg-gray-300 px-4 py-2 text-gray-500">Previous</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="rounded-l-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Previous</a>
        @endif
        {{-- Pagination elements --}}
        @foreach ($elements as $element)
            {{-- Dots separator --}}
            @if (is_string($element))
                <span class="bg-gray-300 px-4 py-2 text-gray-500">{{ $elenent }}</span>
            @endif
            {{-- Array of links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="bg-blue-500 px-4 py-2 text-white">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="bg-gray-200 px-4 py-2 text-gray-700 hover:bg-blue-600 hover:text-white">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="rounded-r-lg bg-blue-500 px-4 py-2 text-white hover:bg-blue-600">Next</a>
        @else
            <span class="rounded-r-lg bg-gray-300 px-4 py-2 text-gray-500">Next</span>
        @endif
    </nav>
@else
@endif
