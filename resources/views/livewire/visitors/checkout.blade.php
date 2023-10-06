<div>
    <div wire:poll.keep-alive x-data="" class="py-4 px-4">

        <div class="row mb-4">
            <div class="col-md-8">
                <h3 class="mb-0"><i class="fa fa-people-roof"></i> Visitas - Checkout de Visitante</h3>
            </div>
        </div>

        <div class="row g-5">
            <div wire:ignore class="col-md-5 col-lg-3">
                <div class="position-sticky" style="top: 2rem;">
                    <div x-on:qrcodescanned="$wire.scan($event.detail)" id="reader" width="600px"></div>
                </div>
            </div>
            <div class="col-md-7 col-lg-9">
                <div class="row mb-3">

                    <div class="col-lg-4 col-xxl-5">
                        <input wire:model.debounce.500ms="searchName" class="form-control" type="text"
                               placeholder="Filtrar por Nome ou Destino" aria-label="default input example" title="Filtrar por Nome ou Destino" />
                    </div>

                    <div class="col-4 col-lg-2 mt-2 mt-lg-0">
                        <input wire:model.debounce.200ms="startDate" type="datetime-local" max="3000-01-01T23:59"
                               title="Filtrar por Entrada" class="form-control text-uppercase" />
                    </div>
                    <div class="col-4 col-lg-2 mt-2 mt-lg-0">
                        <input wire:model.debounce.200ms="endDate" type="datetime-local" max="3000-01-01T23:59"
                               title="Filtrar por Saída" class="form-control text-uppercase" />
                    </div>
                    <div class="col-4 col-lg-2 col-xxl-1 mt-2 mt-lg-0">
                        <select placeholder="Quantidade de Registros" title="Quantidade de Registros" wire:model="pageSize" class="form-select" aria-label="Default select example">
                            <option value="5">5</option>
                            <option value="12">12</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-1 col-lg-2 col-md-3 mt-2 mt-lg-0 d-flex d-none d-lg-block justify-content-end">
                        <div class="view-actions">
                            <button wire:click="showTable" class="view-btn list-view {{ !$showCard ? 'active' : '' }}"
                                title="Visualização em Lista">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                                    <line x1="8" y1="6" x2="21" y2="6"></line>
                                    <line x1="8" y1="12" x2="21" y2="12"></line>
                                    <line x1="8" y1="18" x2="21" y2="18"></line>
                                    <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                    <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                    <line x1="3" y1="18" x2="3.01" y2="18"></line>
                                </svg>
                            </button>
                            <button wire:click="showCard" class="view-btn grid-view {{ $showCard ? 'active' : '' }}"
                                title="Visualização em Grid">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @if ($showCard)
                    <div class="row">
                        @forelse ($visitors as $visitor)
                            <div class="col-12 col-lg-6 col-xxl-4 mb-2">
                                <div class="card people-min-height bg-white">
                                    <div class="card-header bg-blue-light text-white">
                                        <div class="col-12 fw-bolder text-truncate">
                                            {{ $visitor->person->name ?? '' }}
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-3 col-md-4 col-lg-4">
                                                <img src="{{ $visitor->photoTable }}" class="w-100">
                                            </div>
                                            <div class="col-9 col-md-8 col-lg-8">
                                                <div class="row">
                                                    {{--<div class="col-12 fw-bolder lh-sm mb-2">
                                                        {{ $visitor->person->name ?? '' }}
                                                    </div>--}}
                                                    <div class="col-12">
                                                        <div class="badge text-truncate rounded-pill bg-secondary mb-2">
                                                            {{ $visitor->sector->name ?? '' }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="small">
                                                            Entrada:
                                                            {{ $visitor->entranced_at->format('d/m/Y H:i') }}
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="small">
                                                            Saída:
                                                            {{ $visitor->exited_at->format('d/m/Y H:i') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning mt-2">
                                    <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Visita encontrada.
                                </div>
                            </div>
                        @endforelse
                    </div>
                @else
                    <div class="row">
                        <div class="col-12">

                            <div class="row ps-3 fw-bold">
                                <div class="col-md-1 text-center">
                                    Foto
                                </div>
                                <div class="col-md-4">
                                    Visitante
                                </div>
                                <div class="col-md-3 text-left">
                                    Movimentação
                                </div>
                                <div class="col-md-4 text-center">
                                    Destino
                                </div>
                            </div>
                            @forelse ($visitors as $visitor)
                                <div class="cards-striped mx-lg-0 mt-lg-1 my-1">
                                    <div class="card cursor-pointer">
                                        <div class="card-body py-lg-1">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12">
                                                    <div class="row d-flex align-items-center">
                                                        <div class="col-4 col-lg-1 text-center text-lg-start">
                                                            <span data-label="Foto">
                                                                <img class="w-75" src="{{ $visitor->photoTable }}">
                                                            </span>
                                                        </div>
                                                        <div class="col-8 col-lg-11">
                                                            <div class="row d-flex align-items-center">
                                                                <div class="col-5 col-lg-4 text-center text-lg-start">
                                                                    <div class="row">
                                                                        <div class="col-12 fw-bold">
                                                                            <span data-label="Visitante">
                                                                                {{ $visitor->person->name }}
                                                                            </span>

                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span data-label="Documento">
                                                                                {{ $visitor->document?->documentType?->name }}:{{ $visitor?->document?->number }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <span data-label="Entrada">
                                                                                Entrada: {!! $visitor?->entranced_at?->format('d/m/Y  H:i') ?? '-' !!}
                                                                            </span>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <span data-label="Saída">
                                                                                @if (isset($visitor?->exited_at))
                                                                                    Saída: {!! $visitor?->exited_at?->format('d/m/Y  H:i') !!}
                                                                                @else
                                                                                    <span
                                                                                        class="badge bg-warning text-black">
                                                                                        EM ABERTO
                                                                                    </span>
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 col-lg-5 text-center">
                                                                    <span data-label="Destino">
                                                                        {{ $visitor?->sector?->name ?? '-' }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="alert alert-warning mt-2">
                                    <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Visita encontrada.
                                </div>
                            @endforelse
                            @if (!empty($visitors))
                                </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('partials.button-to-top')
</div>
