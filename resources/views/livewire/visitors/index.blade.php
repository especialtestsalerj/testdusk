
<div>
    <div class="py-4 px-4">
        <div class="">
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
                                    'btnNovoLabel' => 'Novo/a',
                                    'btnNovoTitle' => 'Novo/a Visitante',
                                    'routeSearch' => 'visitors.index',
                                    'routeSearchParams' => ['routine_id' => $routine_id],
                                    'routeCreate' => 'visitors.create',
                                    'routeCreateParams' => ['routine_id' => $routine_id, 'redirect' => 'visitors.index'],
                                ]
                            )
                        @else
                            @include(
                                'livewire.partials.search-form',
                                [
                                    'btnNovoLabel' => 'Novo/a',
                                    'btnNovoTitle' => 'Novo/a Visitante',
                                    'routeSearch' => 'visitors.index',
                                    'routeSearchParams' => ['routine_id' => $routine_id, 'redirect' => 'visitors.index'],
                                ]
                            )
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="">
            @include('layouts.msg')

            @include('livewire.visitors.partials.table', ['redirect' => 'visitors.index'])
        </div>
    </div>

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
</div>
