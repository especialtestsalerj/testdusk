
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row border-bottom border-dark mb-4 pb-2">
                <div class="col-md-8">
                    <h3 class="mb-0">Visitas</h3>
                </div>

                <div class="col-4 col-md-4">
                    <div class="float-end">
                        @can('visitors:store')
                            <a id="novo" href="#" class="btn btn-secondary text-white float-right" title="Etiqueta anônima">
                                <i class="fa-solid fa-id-badge"></i> &nbsp;Etiqueta anônima
                            </a>
                        @endCan

                        @can('people:show')
                            <a id="novo" href="{{ route('people.index') }}" class="btn btn-primary text-white float-right" title="Nova Visita">
                                <i class="fa fa-plus"></i> Nova
                            </a>
                        @endCan
                    </div>
                </div>
            </div>

            <div class="row mb-4" >
                <div class="col">
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
            </div>
        </div>

        <div class="">
            @include('layouts.msg')

            @include('livewire.visitors.partials.table', ['redirect' => 'visitors.index'])
        </div>
    </div>

    @include('partials.button-to-top')
    
</div>
