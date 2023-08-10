<div>
    <div class="py-4 px-4 conteudo">
        <div class="">
            <div class="row mb-3">
                <div class="col-md-8">
                    <h3 class="mb-0">Pessoas - Identificação</h3>
                </div>

                <div class="col-md-4">
                    <a id="novo" href="{{ route('visitors.create') }}" class="btn btn-primary text-white float-end"
                        title="Nova Visita">
                        <i class="fa fa-plus"></i> Novo Visitante
                    </a>
                </div>
            </div>

            <div class="row mb-4 d-flex align-items-center">
                <div class="col-12 col-lg-11">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Pesquisar..."
                            wire:model.debounce.500ms="searchString" value="">
                        <span class="input-group-text">
                            <i class="fa fa-search"></i>
                        </span>
                        <span class="input-group-text"
                            onClick="javascript:document.getElementById('searchForm').submit();">
                            <a href="{{ route('people.index') }}">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-12 mt-2 mt-lg-0 col-lg-1 mt-2 mt-lg-0 d-flex justify-content-end">
                    <div class="view-actions">
                        <button wire:click="showTable" class="view-btn list-view {{ !$showCard ? 'active' : '' }}"
                            title="List View">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-list">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-grid">
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

        <div class="">
            @include('layouts.msg')

            @include('livewire.people.partials.table', ['redirect' => 'visitors.index'])
        </div>


        @include('partials.button-to-top')
    </div>

    <div>
        @include('livewire.visitors.partials.badge', [
            'printVisitor' => $printVisitor,
            'forPrinter' => true,
        ])
    </div>
</div>
