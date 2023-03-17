
<div>
    <div class="card card-default mx-0 my-0 mx-lg-5 my-lg-4">
        <div class="card-header py-4 px-4">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mb-0">Rotinas</h2>
                </div>

                <div class="col-md-9">
                    <form action="{{ route('routines.index') }}" id="searchForm">
                        @include(
                            'livewire.partials.search-form',
                            [
                                'btnNovoLabel' => 'Nova',
                                'btnNovoTitle' => 'Nova Rotina',
                                'routeSearch' => 'routines.index',
                                'routeCreate' => 'routines.create', ['redirect' => 'routines.index'],
                            ]
                        )
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @include('layouts.msg')

            @include('livewire.routines.partials.table')
        </div>
    </div>

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
</div>
