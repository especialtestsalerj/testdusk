
@section('content')
    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mb-0">Tipos de Ocorrência</h2>
                </div>

                <div class="col-md-9">
                    <form action="{{ route('event_types.index') }}" id="searchForm">
                        |{{$searchString}}|
                        <input type="text" name="search" class="form-control" placeholder="Pesquisar..." wire:model.debounce.500ms="searchString" value="">
                        <a class="btn btn-outline-secondary" type="button" title="Buscar" onClick="javascript:document.getElementById('searchForm').submit();"><i class="fa fa-search"></i></a>
                        @include(
                            'livewire.partials.search-form',
                            [
                                'routeSearch' => 'event_types.index',
                                'routeCreate' => 'event_types.create',
                            ]
                        )
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('layouts.msg')

            @include('livewire.event_types.partials.table')
        </div>
    </div>
@endsection

