
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-0">Materiais</h2>
                    Rotina {{ $routine->id }} - {{ $routine->entranced_at->format('d/m/Y') }} {{$routine->shift->name}}
                    @if ($routine->status)
                        <label class="badge bg-success"> ABERTA </label>
                    @else
                        <label class="badge bg-danger"> FINALIZADA </label>
                    @endif
                </div>

                <div class="col-md-4">
                    <form action="{{ route('stuffs.index', ['routine_id' => $routine_id]) }}" id="searchForm">
                        @if ($routine->status)
                            @include(
                                'livewire.partials.search-form',
                                [
                                    'btnNovoLabel' => 'Novo',
                                    'btnNovoTitle' => 'Novo Material',
                                    'routeSearch' => 'stuffs.index',
                                    'routeSearchParams' => ['routine_id' => $routine_id],
                                    'routeCreate' => 'stuffs.create',
                                    'routeCreateParams' => ['routine_id' => $routine_id, 'redirect' => 'stuffs.index'],
                                ]
                            )
                        @else
                            @include(
                                'livewire.partials.search-form',
                                [
                                    'btnNovoLabel' => 'Novo',
                                    'btnNovoTitle' => 'Novo Material',
                                    'routeSearch' => 'stuffs.index',
                                    'routeSearchParams' => ['routine_id' => $routine_id, 'redirect' => 'stuffs.index'],
                                ]
                            )
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="">
            @include('layouts.msg')

            @include('livewire.stuffs.partials.table', ['redirect' => 'stuffs.index'])
        </div>
    </div>

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
</div>
