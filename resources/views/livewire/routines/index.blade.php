
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

    <div x-data="{ showButton: false }" @scroll.window="showButton = (window.pageYOffset > 100)" class="text-center pb-5 py-4"
        style="position: fixed; bottom: 10px; right: 10px;" x-show="showButton">
        <a href="#" @click.prevent="window.scrollTo({ top: 0, behavior: 'smooth' })" class="btn btn-primary"
            title="Voltar para o topo">
            <i class="fa-solid fa-arrow-up"></i>
        </a>
    </div>
</div>
