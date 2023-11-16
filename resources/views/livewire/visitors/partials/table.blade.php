<div>
    <!-- Visão dos Cards -->
    @if ($showCard)
        <div class="row">
            @forelse ($visitors as $visitor)
                <div class="col-md-6 col-lg-4 col-xxl-3 mb-2">
                    <div class="card bg-white">
                        <div class="card-header bg-blue-light text-white">
                            <div class="row d-flex align-items-center">
                                <div class="col-8 fw-bolder d-inline-block d-inline-block text-truncate">
                                    <div data-label="Visitante">
                                        {{ $visitor->person->name }}
                                    </div>
                                </div>
                                <div class="col-4 d-flex justify-content-end pe-1">

                                    {{--
                                    <span class="btn btn-primary px-1 py-0" wire:click="generateBadge({{ $visitor->id }})" title="Imprimir Etiqueta">
                                        <i class="fa fa-lg fa-print"></i>
                                    </span>

                                    @can('visitors:show')
                                        <a href="{{ route('visitors.show', ['visitor' => $visitor, 'redirect' => $redirect, 'disabled' => true]) }}" class="btn btn-primary px-1 py-0" title="Detalhar">
                                            <i class="fa fa-lg fa-search"></i>
                                        </a>
                                    @endCan

                                    @can('visitors:update')
                                        <a href="{{ route('visitors.show', ['visitor' => $visitor, 'redirect' => $redirect, 'disabled' => false]) }}"
                                           class="btn btn-primary px-1 py-0" title="Alterar"><i
                                                class="fa fa-lg fa-pencil"></i>
                                        </a>
                                    @endCan
--}}

                                    @if (!$visitor->exited_at)
                                        @can('visitors:checkout')
                                            <span class="btn btn-primary px-1 py-0 btn-visit-action"
                                                wire:click="prepareForCheckout({{ $visitor->id }})" title="Registrar Saída">
                                                <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                            </span>
                                        @endCan
                                    @else
                                        @if(!$visitor->hasPendingVisit())
                                            @can('visitors:store')
                                                <a href="{{ route('visitors.create', ['document_id' => $visitor->document?->id]) }}"
                                                   class="btn btn-primary px-1 py-0 btn-visit-action" title="Registrar Entrada">
                                                    <i class="fa fa-lg fa-check"></i>
                                                </a>
                                            @endCan
                                        @endIf
                                    @endIf
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-0 ps-0">
                            <div class="row">
                                <div class="col-5 d-flex pe-0" data-label="Foto">
                                    <div class="photo-bg align-items-stretch">
                                        <img class="w-100 photo-card" src="{{ $visitor->photoTable }}">
                                    </div>
                                </div>

                                <div class="col-7 d-flex flex-column visitor-data">
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-10 pe-0 d-flex justify-content-end">
                                                    <div data-label="Destino" class="badge text-truncate rounded-pill bg-secondary mb-1">
                                                        {{$visitor?->sectors?->first()?->name}}
                                                    </div>
                                                </div>
                                                @if(count($visitor?->sectors) > 1)
                                                    <div class="col-2 px-0 text-start text-white fix-align-top">


                                                        <span class="badge bg-danger rounded-circle more-destinys"
                                                              data-bs-toggle="tooltip"
                                                              data-bs-placement="top"
                                                              data-bs-custom-class="custom-tooltip"
                                                              data-bs-html="true"
                                                              data-bs-title="@foreach($visitor?->sectors as $sector)<div class='fw-bold mt-1 pt-0 pb-0 multiple-destiny text-truncate'>{{$sector->name}}</div>@endforeach">
                                                            +{{count($visitor->sectors) - 1}}
                                                        </span>


                                                    </div>
                                                @endif
                                            </div>

                                            <div data-label="Entrada">
                                                Entrada:
                                                <strong>{!! $visitor?->entranced_at?->format('d/m/Y H:i') ?? '-' !!}</strong>
                                            </div>
                                            <div data-label="Saída">
                                                Saida: @if (isset($visitor?->exited_at))
                                                    <strong>
                                                        {!! $visitor?->exited_at?->format('d/m/Y H:i') !!}
                                                    </strong>
                                                @else
                                                    <span class="badge bg-warning text-black">EM ABERTO</span>
                                                @endif
                                            </div>
                                            <div data-label="Documento">
                                                {{ $visitor->document?->documentType?->name }}:
                                                <strong>
                                                    {{ $visitor?->document?->numberMaskered }}
                                                </strong>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row card-buttons mt-auto d-flex">
                                        <div class="d-flex justify-content-center">
                                            <div class="col-3 justify-content-center">
                                            <span class="btn btn-link px-0 pt-0 pb-1"
                                                  wire:click="generateBadge({{ $visitor->id }})"
                                                  title="Imprimir Etiqueta">
                                                <i class="fa fa-lg fa-print"></i>
                                            </span>
                                            </div>
                                            <div class="col-3 justify-content-center">
                                                @can('visitors:show')
                                                    <a href="{{ route('visitors.show', ['visitor' => $visitor, 'redirect' => $redirect, 'disabled' => true]) }}"
                                                       class="btn btn-link px-0 pt-0 pb-1" title="Detalhar"><i
                                                            class="fa fa-lg fa-search"></i>
                                                    </a>
                                                @endCan
                                            </div>
                                            <div class="col-3 justify-content-center">
                                                @can('visitors:update')
                                                    <a href="{{ route('visitors.show', ['visitor' => $visitor, 'redirect' => $redirect, 'disabled' => false]) }}"
                                                       class="btn btn-link px-0 pt-0 pb-1" title="Alterar"><i
                                                            class="fa fa-lg fa-pencil"></i>
                                                    </a>
                                                @endCan
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
        <!-- FIM da VISÃO DOS CARDS -->
        <!-- VISÃO DE TABELA -->
        <div class="row">
            <div class="col-md-12">
                <div class="mx-lg-0 my-1">
                    <div class="">
                        <div class="py-lg-1">
                            <div class="row d-flex align-items-center">
                                <div class="col-12 col-lg-10">
                                    <div class="row d-flex align-items-center fw-bold ps-2">
                                        <div class="col-3 col-lg-1 text-center">
                                            Foto
                                        </div>
                                        <div class="col-9 col-lg-11">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-5 col-lg-5 text-center text-lg-start ps-3">
                                                    Identificação
                                                </div>
                                                <div class="col-lg-3">
                                                    Movimentação
                                                </div>
                                                <div class="col-3 col-lg-4 text-center">
                                                    Destino
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @forelse ($visitors as $visitor)
                    <div class="cards-striped mx-lg-0 mt-lg-1 my-1">
                        <div class="card">
                            <div class="card-body py-lg-1">
                                <div class="row d-flex align-items-center">
                                    <div class="col-12 col-lg-10">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-3 col-lg-1 text-center text-lg-start">
                                                <img class="w-75" src="{{ $visitor->photoTable }}">
                                            </div>
                                            <div class="col-9 col-lg-11">
                                                <div class="row d-flex align-items-center">
                                                    <div class="col-4 col-lg-5 text-center text-lg-start">
                                                        <div class="row">
                                                            <div class="col-12 fw-bold">
                                                                <div data-label="Visitante">
                                                                    {{ $visitor->person->name }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div data-label="Documento">
                                                                    {{ $visitor->document?->documentType?->name }}:
                                                                    {{ $visitor?->document?->numberMaskered }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-lg-3">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div data-label="Entrada">
                                                                    Entrada: <span>{!! $visitor?->entranced_at?->format('d/m/Y  H:i') ?? '-' !!}</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div data-label="Saída">
                                                                    Saída: <span>@if (isset($visitor?->exited_at))
                                                                            {!! $visitor?->exited_at?->format('d/m/Y H:i') !!}
                                                                        @else
                                                                            <span class="badge bg-warning text-black">EM ABERTO</span>
                                                                        @endif</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 col-lg-4 text-center">
                                                        <div data-label="Setor de Destino">
                                                            {{ $visitor?->sectorsResumed ?? '-' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-2 text-center text-lg-end actions">
                                        <span class="btn btn-link px-1" wire:click="generateBadge({{ $visitor->id }})" title="Imprimir Etiqueta">
                                            <i class="fa fa-lg fa-print"></i>
                                        </span>
                                        @can('visitors:show')
                                            <a href="{{ route('visitors.show', ['visitor' => $visitor->id, 'redirect' => $redirect, 'disabled' => true]) }}"
                                               class="btn btn-link px-1" title="Detalhar"><i class="fa fa-lg fa-search"></i></a>
                                        @endCan
                                        @can('visitors:update')
                                            <a href="{{ route('visitors.show', ['visitor' => $visitor->id, 'redirect' => $redirect, 'disabled' => false]) }}"
                                               class="btn btn-link px-1" title="Alterar"><i class="fa fa-lg fa-pencil"></i></a>
                                        @endCan
                                        @if (!$visitor->exited_at)
                                            @can('visitors:checkout')
                                                <span class="btn btn-link px-1" wire:click="prepareForCheckout({{ $visitor->id }})" title="Registrar Saída">
                                                    <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                                </span>
                                            @endCan
                                        @else
                                            @if(!$visitor->hasPendingVisit())
                                                @can('visitors:store')
                                                    <a href="{{ route('visitors.create', ['document_id' => $visitor->document->id]) }}"
                                                       class="btn btn-link px-0 py-0" title="Registrar Entrada">
                                                        <i class="fa fa-lg fa-check"></i>
                                                    </a>
                                                @endCan
                                            @endIf
                                        @endIf
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
        </div>
        <!-- FIM DA VISÃO DE TABELA -->
    @endif

    <div class="d-flex justify-content-center mt-4">
        {{ $visitors->links() }}
    </div>

</div>
