
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row border-bottom border-dark mb-4 pb-2">
                <div class="col-md-8">
                    <h3 class="mb-0">Visitas</h3>
                </div>

                <div class="col-4 col-md-4">
                    <a id="novo" href="{{ route('visitors.create') }}" class="btn btn-primary text-white float-end" title="Nova Visita">
                        <i class="fa fa-plus"></i> Nova
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

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
</div>
