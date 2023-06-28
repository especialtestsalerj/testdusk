
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mb-0">Rotinas</h2>
                </div>

                <div class="col-md-9">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'btnNovoLabel' => 'Nova',
                            'btnNovoTitle' => 'Nova Rotina',
                            'routeSearch' => 'routines.index',
                            'routeCreate' => 'routines.create',
                        ]
                    )
                </div>
            </div>
        </div>

        <div class="p-0">
            @include('layouts.msg')

            @include('livewire.routines.partials.table')
        </div>
    </div>

    @include('partials.button-to-top')
</div>
