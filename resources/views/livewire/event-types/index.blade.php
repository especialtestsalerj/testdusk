

    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mb-0">Tipos de Ocorrência</h2>
                </div>

                <div class="col-md-9">
                    <form action="{{ route('event-types.index') }}" id="searchForm">
                        @include(
                            'livewire.partials.search-form',
                            [
                                'routeSearch' => 'event-types.index',
                                'routeCreate' => 'event-types.create',
                            ]
                        )
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('layouts.msg')

            @include('livewire.event-types.partials.table')
        </div>
    </div>
