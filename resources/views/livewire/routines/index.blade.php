
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-0"><i class="fa fa-clipboard-list"></i> Rotinas</h3>
                </div>

                <div class="col-md-6">
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
