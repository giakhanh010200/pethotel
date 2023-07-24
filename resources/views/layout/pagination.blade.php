<div class="pagination:container">
    <div class="pagination:arrow">
        @if ($paginator->onFirstPage())
            <i class="fas fa-caret-left"></i>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev">
                <i class="fas fa-caret-left"></i>
            </a>
        @endif
    </div>
    @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
            <div class="pagination:number">
                {{ $element }}
            </div>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <div class="pagination:number active">
                        {{ $page }}
                    </div>
                @else
                    <div class="pagination:number">
                        <a href="{{ $url }}">{{ $page }}</a>
                    </div>
                @endif
            @endforeach
        @endif
    @endforeach

    <div class="pagination:arrow">
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next">
                <i class="fas fa-caret-right"></i>
            </a>
        @else
            <i class="fas fa-caret-right"></i>
        @endif
    </div>
</div>
