<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row border-bottom border-dark mb-4 pb-2">
                <div class="col-md-8">
                    <h3 class="mb-0">Pessoas - Identificação</h3>
                </div>

                <div class="col-md-4">
                    <a id="novo" href="{{ route('visitors.create') }}" class="btn btn-primary text-white float-end" title="Nova Visita">
                        <i class="fa fa-plus"></i> Nova Visita
                    </a>
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
                            <a href="{{ route('people.index') }}">
                                <i class="fas fa-eraser"></i>
                            </a>
                        </span>
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
</div>
