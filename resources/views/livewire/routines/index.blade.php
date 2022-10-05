

    <div class="card card-default">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h2 class="mb-0">Rotinas</h2>
                </div>

                <div class="col-md-9">
                    <form action="{{ route('routines.index') }}" id="searchForm">
                        @include(
                            'livewire.partials.search-form',
                            [
                                'routeSearch' => 'routines.index',
                                'routeCreate' => 'routines.create',
                            ]
                        )
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            @include('layouts.msg')

            @include('livewire.routines.partials.table')
        </div>
    </div>
