

<div class="card card-default">
    <div class="card-header">
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-0">Visitantes</h2>
                Rotina {{ $routine->id }} - {{ $routine->entranced_at->format('d/m/Y') }} {{$routine->shift->name}}
                @if ($routine->status)
                    <label class="badge bg-success"> ABERTA </label>
                @else
                    <label class="badge bg-danger"> FINALIZADA </label>
                @endif
            </div>

            <div class="col-md-4">
                <form action="{{ route('visitors.index', ['routine_id' => $routine_id]) }}" id="searchForm">
                    @if ($routine->status)
                        @include(
                            'livewire.partials.search-form',
                            [
                                'routeSearch' => 'visitors.index',
                                'routeCreate' => 'visitors.createFromDashboard',
                                'routeSearchParams' => ['routine_id' => $routine_id],
                                'routeCreateParams' => ['routine_id' => $routine_id],
                            ]
                        )
                    @else
                        @include(
                            'livewire.partials.search-form',
                            [
                                'routeSearch' => 'visitors.index',
                                'routeSearchParams' => ['routine_id' => $routine_id],
                            ]
                        )
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="card-body">
        @include('layouts.msg')

        @include('livewire.visitors.partials.table')
    </div>
</div>

<div class="text-center py-4">
    <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
</div>
