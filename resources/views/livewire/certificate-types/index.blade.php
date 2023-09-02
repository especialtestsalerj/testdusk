
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="mb-0"><i class="fa fa-list-ol"></i> Tipos de Porte</h3>
                </div>

                <div class="col-md-9">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'btnNovoLabel' => 'Novo',
                            'btnNovoTitle' => 'Novo Tipo de Porte',
                            'routeSearch' => 'certificate-types.index',
                            'routeCreate' => 'certificate-types.create',
                        ]
                    )
                </div>
            </div>
        </div>

        <div class="p-0">
            @include('layouts.msg')

            @include('livewire.certificate-types.partials.table')
        </div>
    </div>

    @include('partials.button-to-top')
</div>
