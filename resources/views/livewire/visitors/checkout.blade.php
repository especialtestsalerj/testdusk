<div>
    <div wire:poll.keep-alive x-data="" class="py-4 px-4">

        <div class="row border-bottom border-dark mb-4 pb-2">
            <div class="col-md-8">
                <h3 class="mb-0">Visitas - Checkout de Visitante</h3>
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
                    <div class="col-lg-5">
                        <input wire:model.debounce.500ms="searchName" class="form-control" type="text"
                            placeholder="Filtrar por nome" aria-label="default input example">
                    </div>
                    <div class="col-3 col-lg-2 mt-2 mt-lg-0">
                        <input wire:model.debounce.200ms="startDate" type="datetime-local" max="3000-01-01T23:59"
                            class="form-control text-uppercase" />
                    </div>
                    <div class="col-3 col-lg-2 mt-2 mt-lg-0">
                        <input wire:model.debounce.200ms="endDate" type="datetime-local" max="3000-01-01T23:59"
                            class="form-control text-uppercase" />
                    </div>
                    <div class="col-3 col-lg-2 mt-2 mt-lg-0">
                        <select wire:model="pageSize" class="form-select" aria-label="Default select example">
                            <option value="5">5</option>
                            <option value="12">12</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="col-1 mt-2 mt-lg-0">
                        <div class="view-actions">
                            <button wire:click="showTable" class="view-btn list-view {{ !$showCard ? 'active' : '' }}"
                                title="List View">
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
                                title="Grid View">
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
                        @foreach ($visitors as $visitor)
                            <div class="col-12 col-xxl-4 mb-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3 col-md-4">
                                                <img src="{{ $visitor->photo }}" class="w-100">
                                            </div>
                                            <div class="col-9 col-md-8">
                                                <div class="row">
                                                    <div class="col-12">
                                                        {{ $visitor->person->name }}
                                                        {{--                                            </strong> --}}
                                                    </div>
                                                    <div class="col-12">
                                                        {{ $visitor->sector->name }}
                                                        {{--                                            </strong> --}}
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-12">
                                                            <div class="small fw-bold">
                                                                <i class="fas fa-calendar-day me-2"></i>Entrada
                                                                <strong>
                                                                    {{ $visitor->entranced_at->format('d/m/Y - H:i') }}
                                                                </strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="small fw-bold">
                                                                {{ is_null($visitor->exited_at) ? dd($visitor) : '' }}
                                                                <i class="fas fa-calendar-day me-2"></i>Saída
                                                                <strong>{{ $visitor->exited_at->format('d/m/Y - H:i') }}</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endForEach
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12">
                            @if (!empty($visitors))
                                <table class="table-dynamic table table-striped">
                                    <thead>
                                        <tr>
                                            <td class="col-md-1">Foto</td>
                                            <td class="col-md-1">Entrada</td>
                                            <td class="col-md-1">Saída</td>
                                            <td class="col-md-3">Visitante</td>
                                            <td class="col-md-2">Documento</td>
                                            <td class="col-md-2">Destino</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                            @endif
                            @forelse ($visitors as $visitor)
                                <tr class="align-middle">
                                    <td data-label="Foto">
                                        <img class="w-75" src="{{ $visitor->photo }}">
                                    </td>
                                    <td data-label="Entrada">{!! $visitor?->entranced_at?->format('d/m/Y \<\b\r\> H:i') ?? '-' !!}</td>
                                    <td data-label="Saída">
                                        @if (isset($visitor?->exited_at))
                                            {!! $visitor?->exited_at?->format('d/m/Y \<\b\r\> H:i') !!}
                                        @else
                                            <span class="badge bg-warning text-black">EM ABERTO</span>
                                        @endif
                                    </td>
                                    <td data-label="Visitante">{{ $visitor->person->name }}</td>
                                    <td data-label="Documento">{{ $visitor->document?->documentType?->name }}:
                                        {{ $visitor?->document?->number }}</td>
                                    <td data-label="Setor de Destino">{{ $visitor?->sector?->name ?? '-' }}</td>

                                </tr>

                            @empty
                                <div class="alert alert-warning mt-2">
                                    <i class="fa fa-exclamation-triangle"></i> Nenhuma Visita encontrada.
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
