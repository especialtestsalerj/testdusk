
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-0"><i class="fas fa-list"></i> Tipos de Ocorrência</h3>
                </div>

                <div class="col-md-6">
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

        <div class="p-0">
            @include('layouts.msg')

            @include('livewire.event-types.partials.table')
        </div>
    </div>

    @include('partials.button-to-top')
</div>
