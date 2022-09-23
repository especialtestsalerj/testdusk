

<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col-md-3">
                <h2 class="mb-0">Setores</h2>
            </div>

            <div class="col-md-9">
                <form action="{{ route('sectors.index') }}" id="searchForm">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'routeSearch' => 'sectors.index',
                            'routeCreate' => 'sectors.create',
                        ]
                    )
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        @include('layouts.msg')

        @include('livewire.sectors.partials.table')
    </div>
</div>
