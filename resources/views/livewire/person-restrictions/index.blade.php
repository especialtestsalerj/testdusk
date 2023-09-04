
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-3">
                    <h3 class="mb-0"><i class="fas fa-person-circle-exclamation"></i> Restrições de Acesso</h3>
                </div>

                <div class="col-md-9">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'btnNovoLabel' => 'Nova',
                            'btnNovoTitle' => 'Nova Restrição',
                            'routeSearch' => 'person-restrictions.index',
                            'routeCreate' => 'person-restrictions.create',
                        ]
                    )
                </div>
            </div>
        </div>

        <div class="p-0">
            @include('layouts.msg')

            @include('livewire.person-restrictions.partials.table')
        </div>
    </div>

    @include('partials.button-to-top')
</div>
