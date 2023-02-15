

    <div class="card card-default mx-4 my-5">
        <div class="card-header py-4 px-4">
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

        <div class="card-body p-0">
            @include('layouts.msg')

            @include('livewire.event-types.partials.table')
        </div>
    </div>
