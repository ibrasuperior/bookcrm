@if ($paginator->hasPages())
<div class="ls-pagination-filter">
    <ul class="ls-pagination" style="float:left !important;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li aria-label="@lang('pagination.previous')">
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;Anterior</a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;Anterior</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="ls-active" aria-current="page"><span class="page-link"></span><a href="{{ $url }}">{{ $page }}</a></li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">Próximo&rsaquo;</a>
            </li>
        @endif
    </ul>

</div>
 
</div>

<style>
 .ls-pagination li:hover{
     background-color:#ccc;
 }
</style>
@endif
