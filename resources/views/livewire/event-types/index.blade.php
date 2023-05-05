
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mb-0">Tipos de Ocorrência</h2>
                </div>

                <div class="col-md-9">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'btnNovoLabel' => 'Novo',
                            'btnNovoTitle' => 'Novo Tipo de Ocorrência',
                            'routeSearch' => 'event-types.index',
                            'routeCreate' => 'event-types.create',
                        ]
                    )
                </div>
            </div>
        </div>

        <div class="card-body my-2">
            @include('layouts.msg')

            @include('livewire.event-types.partials.table')
        </div>
    </div>

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
</div>
