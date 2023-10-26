@if ($paginator->hasPages())
    <div class="d-none d-sm-flex align-items-sm-center justify-content-sm-between">

        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : $this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1)

        <nav>
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">&lsaquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <button type="button"
                                dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                class="page-link" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">
                            &lsaquo;
                        </button>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled" aria-disabled="true"><span
                                class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"
                                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}"
                                    aria-current="page"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"
                                    wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page-{{ $page }}">
                                    <button type="button" class="page-link"
                                            wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button type="button"
                                dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                                class="page-link" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                                wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">&rsaquo;
                        </button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">&rsaquo;</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

{{--MOBILE--}}
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="d-flex justify-content-between flex-fill d-sm-none">
            <ul class="pagination">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <span class="page-link" aria-hidden="true">«</span>
                    </li>
                @else
                    <li class="page-item">
                        <button class="page-link" wire:click="previousPage" aria-label="@lang('pagination.previous')">«</button>
                    </li>
                @endif

                @if ($paginator->currentPage() > 2)
                    <li class="page-item">
                        <button class="page-link" wire:click="gotoPage(1)">1</button>
                    </li>
                @endif

                @if ($paginator->currentPage() > 3)
                    <li class="page-item"><span class="page-link">...</span></li>
                @endif

                @for ($i = max(1, $paginator->currentPage() - 1); $i <= min($paginator->lastPage(), $paginator->currentPage() + 1); $i++)
                    @if ($i == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <button class="page-link" wire:click="gotoPage({{ $i }})">{{ $i }}</button>
                        </li>
                    @endif
                @endfor

                @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                    <li class="page-item"><span class="page-link">...</span></li>
                @endif

                @if ($paginator->currentPage() < $paginator->lastPage() - 1)
                    <li class="page-item">
                        <button class="page-link" wire:click="gotoPage({{ $paginator->lastPage() }})">{{ $paginator->lastPage() }}</button>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <button class="page-link" wire:click="nextPage" aria-label="@lang('pagination.next')">»</button>
                    </li>
                @else
                    <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <span class="page-link" aria-hidden="true">»</span>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

@endif
