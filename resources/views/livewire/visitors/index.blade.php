<div wire:poll.keep-alive>
    <div class="py-4 px-4 conteudo">
        <div class="">
            <div class="row mb-4 d-flex align-items-center">
                <div class="col-4 col-md-6">
                    <h3 class="mb-0"><i class="fa fa-people-roof"></i> Visitas</h3>
                </div>

                <div class="col-8 col-md-6">
                    <div class="float-end">
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
            </div>

            <div class="row mb-4 d-flex align-items-center">
                <div class="col-6 col-md-9 col-lg-8 col-xxl-9 pe-0">
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
                <div class="col-6 mt-lg-0 col-md-3 col-lg-2 col-xxl-2 d-flex justify-content-start justify-content-lg-end">
                    <span class="fw-bold btn btn-outline-secondary">
                        <input type="checkbox" name="exited_at"
                               wire:model="exited_at"><span class="ms-2">Saída em Aberto</span>
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
