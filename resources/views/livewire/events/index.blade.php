
<div>
    <div class="mx-0 my-0 mx-lg-5 my-lg-4">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-0">Ocorrências</h2>
                    Rotina {{ $routine->id }} - {{ $routine->entranced_at->format('d/m/Y') }} {{$routine->shift->name}}
                    @if ($routine->status)
                        <label class="badge bg-success"> ABERTA </label>
                    @else
                        <label class="badge bg-danger"> FINALIZADA </label>
                    @endif
                </div>

                <div class="col-md-4">
                    <form action="{{ route('events.index', ['routine_id' => $routine_id]) }}" id="searchForm">
                        @if ($routine->status)
                            @include(
                                'livewire.partials.search-form',
                                [
                                    'btnNovoLabel' => 'Nova',
                                    'btnNovoTitle' => 'Nova Ocorrência',
                                    'routeSearch' => 'events.index',
                                    'routeSearchParams' => ['routine_id' => $routine_id],
                                    'routeCreate' => 'events.create',
                                    'routeCreateParams' => ['routine_id' => $routine_id, 'redirect' => 'events.index'],
                                ]
                            )
                        @else
                            @include(
                                'livewire.partials.search-form',
                                [
                                    'btnNovoLabel' => 'Nova',
                                    'btnNovoTitle' => 'Nova Ocorrência',
                                    'routeSearch' => 'events.index',
                                    'routeSearchParams' => ['routine_id' => $routine_id, 'redirect' => 'events.index'],
                                ]
                            )
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="">
            @include('layouts.msg')

            @include('livewire.events.partials.table', ['redirect' => 'events.index'])
        </div>
    </div>

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
</div>
