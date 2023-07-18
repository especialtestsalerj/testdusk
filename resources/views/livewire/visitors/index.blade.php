
<div>
    <div class="py-4 px-4 conteudo">
        <div class="">
            <div class="row border-bottom border-dark mb-4 pb-2">
                <div class="col-md-8">
                    <h3 class="mb-0">Visitas</h3>
                </div>

                <div class="col-md-4">
                    <div class="float-end">
                        @can('visitors:store')
                            <span class="btn btn-secondary text-white float-right" wire:click="generateBadge(null)" title="Imprimir Etiqueta Anônima">
                                <i class="fa fa-print"></i> &nbsp;Etiqueta Anônima
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

            <div class="row mb-4" >
                <div class="col-12">
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
                <div class="col-12 mt-1 ml-5 pl-5">
                    <span>
                        <input type="checkbox" name="exited_at"
                               wire:model="exited_at"> Somente Saída em Aberto
                    </span>
                </div>
            </div>
        </div>

        <div class="">
            @include('layouts.msg')

            @include('livewire.visitors.partials.table', ['redirect' => 'visitors.index'])
        </div>
    </div>

    <div>
{{--        @include('livewire.visitors.partials.badge', [$printVisitor])--}}
    </div>


    @include('partials.button-to-top')

</div>
