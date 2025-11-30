@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">

        <div class="d-flex flex-sm-fill align-items-sm-center justify-content-sm-between">
            <div class="d-none d-sm-block">
                <p class="small text-muted">
                    {!! __('Showing') !!}
                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                    {!! __('of') !!}
                    <span class="fw-semibold">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>


            <div>
                <ul class="pagination">

                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">&lsaquo;</span>
                        </li>
                    @else
                        <li class="page-item">
                            <button type="button" class="page-link" wire:click="previousPage" onclick="updatePageQuery({{ $paginator->currentPage() - 1 }});" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</button>
                        </li>
                    @endif

                    @foreach ($elements as $element)
                        {{-- "Három pont" elválasztó --}}
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                                @else
                                    <li class="page-item">
                                        {{-- Gomb wire:click-kel, ami átadja az oldalszámot --}}
                                        <button type="button" class="page-link" wire:click="gotoPage({{ $page }})" onclick="updatePageQuery({{ $page }});">{{ $page }}</button>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <button type="button" class="page-link" wire:click="nextPage" onclick="updatePageQuery({{ $paginator->currentPage() + 1 }});" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</button>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link" aria-hidden="true">&rsaquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
@endif
