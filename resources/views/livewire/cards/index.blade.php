<div>
    <div class="py-4 px-4">
        <div>
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-0"><i class="fa fa-id-card"></i> Cartões</h3>
                </div>

                <div class="col-md-6">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'btnNovoLabel' => 'Novo',
                            'btnNovoTitle' => 'Novo Cartão',
                            'routeSearch' => 'cards.index',
                            'routeCreate' => 'cards.create',
                        ]
                    )
                </div>
            </div>
        </div>

        <div class="p-0">
            @include('layouts.msg')

            @include('livewire.cards.partials.table')
        </div>
    </div>

    @include('partials.button-to-top')
</div>
