
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-0">Cautelas de Armas</h2>
                    Rotina {{ $routine->code }} - {{ $routine->entranced_at->format('d/m/Y') }} {{$routine->shift->name}}
                    @if ($routine->status)
                        <label class="badge bg-success"> ABERTA </label>
                    @else
                        <label class="badge bg-danger"> FINALIZADA </label>
                    @endif
                </div>

                <div class="col-md-4">
                    @if ($routine->status)
                        @include(
                            'livewire.partials.search-form',
                            [
                                'btnNovoLabel' => 'Nova',
                                'btnNovoTitle' => 'Nova Cautela de Arma',
                                'routeSearch' => 'cautions.index',
                                'routeSearchParams' => ['routine_id' => $routine_id],
                                'routeCreate' => 'cautions.create',
                                'routeCreateParams' => ['routine_id' => $routine_id, 'redirect' => 'cautions.index'],
                            ]
                        )
                    @else
                        @include(
                            'livewire.partials.search-form',
                            [
                                'btnNovoLabel' => 'Nova',
                                'btnNovoTitle' => 'Nova Cautela de Arma',
                                'routeSearch' => 'cautions.index',
                                'routeSearchParams' => ['routine_id' => $routine_id, 'redirect' => 'cautions.index'],
                            ]
                        )
                    @endif
                </div>
            </div>
        </div>

        <div class="">
            @include('layouts.msg')

            @include('livewire.cautions.partials.table', ['redirect' => 'cautions.index'])
        </div>
    </div>

    <div class="text-center py-4">
        <a href="{{ url('/dashboard') }}" title="Ir para a Home">Home</a>
    </div>
</div>
