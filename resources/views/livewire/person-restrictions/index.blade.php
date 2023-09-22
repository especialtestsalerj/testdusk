
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-0"><i class="fas fa-person-circle-exclamation"></i> Restrições de Acesso</h3>
                </div>

                <div class="col-md-6">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'routeSearch' => 'person-restrictions.index',
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
