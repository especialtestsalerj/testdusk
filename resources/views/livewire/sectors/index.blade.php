
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mb-0">Setores</h2>
                </div>

                <div class="col-md-9">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'btnNovoLabel' => 'Novo',
                            'btnNovoTitle' => 'Novo Setor',
                            'routeSearch' => 'sectors.index',
                            'routeCreate' => 'sectors.create',
                        ]
                    )
                </div>
            </div>
        </div>

        <div class="card-body my-2">
            @include('layouts.msg')

            @include('livewire.sectors.partials.table')
        </div>
    </div>

    @include('partials.button-to-top')
</div>
