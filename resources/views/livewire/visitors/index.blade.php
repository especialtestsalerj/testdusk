<div>
    <div class="py-4 px-4 conteudo">
        <div class="">
            <div class="row mb-4 d-flex align-items-center">
                <div class="col-4 col-md-4">
                    <h3 class="mb-0"><i class="fa fa-people-roof"></i> Visitas</h3>
                </div>

                <?php
                    $qtdPendingVisitors = $pendingVisitors->count();
                ?>

                <div class="col-4 col-md-4 align-self-center d-flex justify-content-center">
                    @if($qtdPendingVisitors > 0)
                        @can('visitors:checkout-all')
                            <button type="button" class="btn btn-secondary text-white float-right" data-bs-toggle="modal" data-bs-target="#checkoutModal" title="Finalizar todas as visitas em aberto" dusk="CheckoutPendingVisitors">
                                <i class="fa fa-check-double"></i> Finalizar Visitas em Aberto
                            </button>
                        @endCan
                    @endif
                </div>

                <div class="col-4 col-md-4 align-self-center d-flex justify-content-end gap-4">
                    @can('visitors:store')
                        <span class="btn btn-secondary text-white float-right" wire:click="generateBadge(null)" title="Imprimir Etiqueta Avulsa">
                            <i class="fa fa-print"></i> Etiqueta Avulsa
                        </span>
                    @endCan

                    @can('people:show')
                        <a id="novo" href="{{ route('people.index') }}" class="btn btn-primary text-white float-right" title="Nova Visita">
                            <i class="fa fa-plus"></i> Nova
                        </a>
                    @endCan
                </div>
            </div>

            <div class="row mb-4 d-flex align-items-center">
                <div class="col-6 col-md-8 col-lg-7 col-xxl-9 pe-0">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Pesquisar..." wire:model.debounce.500ms="searchString" value="">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                        <span class="input-group-text" onClick="javascript:document.getElementById('searchForm').submit();">
                            <a href="{{ route('visitors.index') }}">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-6 mt-lg-0 col-md-4 col-lg-3 col-xxl-2 d-flex justify-content-start justify-content-lg-end">
                    <span class="fw-bold btn btn-outline-secondary">
                        <input type="checkbox" name="openedExitFilter"
                               wire:model="openedExitFilter"><span class="ms-2">Saída em Aberto</span>
                    </span>
                </div>
                <div class="col-2 mt-2 mt-lg-0 col-lg-2 col-xxl-1 mt-2 mt-lg-0 d-flex justify-content-end d-none d-lg-block">
                    <div class="view-actions">
                        <button wire:click="showTable" class="view-btn list-view {{!$showCard ? 'active' : ''}}" title="Visualização em Lista">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                                <line x1="8" y1="6" x2="21" y2="6"></line>
                                <line x1="8" y1="12" x2="21" y2="12"></line>
                                <line x1="8" y1="18" x2="21" y2="18"></line>
                                <line x1="3" y1="6" x2="3.01" y2="6"></line>
                                <line x1="3" y1="12" x2="3.01" y2="12"></line>
                                <line x1="3" y1="18" x2="3.01" y2="18"></line>
                            </svg>
                        </button>
                        <button wire:click="showCard" class="view-btn grid-view {{$showCard ? 'active' : ''}}" title="Visualização em Grid">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @if($qtdPendingVisitors > 0)
        <!-- Modal -->
        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true" wire:ignore>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="form" action="{{ route('visitors.checkout_all') }}" method="post">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="checkoutModalLabel"><i class="fa fa-check-double"></i> Finalização de Visitas em Aberto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exited_at">Saída*</label>
                                <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" value="{{ is_null(old('exited_at')) ? $exited_at?->format('Y-m-d H:i') : old('exited_at') }}"/>
                            </div>
                            <div class="alert alert-warning" role="alert">
                                <p><i class="fa fa-triangle-exclamation"></i><strong> Atenção</strong></p>
                                <hr>
                                @if($qtdPendingVisitors > 0)
                                    <p>Total de Visitas em Aberto: {{ $qtdPendingVisitors }}</p>
                                @endif
                                <hr>
                                <p class="text-justify">Ao salvar, todas as visitas serão finalizadas com a data de saída informada acima.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm text-white close-modal" id="submitCheckoutPendingVisitors" title="Confirmar Finalização"><i class="fa fa-save"></i> Confirmar</button>
                            <button type="button" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal" title="Fechar Formulário"><i class="fa fa-ban"></i> Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <div class="p-0">
            @include('layouts.msg')

            @include('livewire.visitors.partials.table', ['redirect' => 'visitors.index'])
        </div>
    </div>

    <div>
        @include('livewire.visitors.partials.badge', ['printVisitor' => $printVisitor, 'forPrinter'=>true])
    </div>

    @include('partials.button-to-top')
</div>
