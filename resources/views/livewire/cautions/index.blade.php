<div>
    <div class="py-4 px-4 conteudo">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="mb-0">Cautelas de Armas</h3>
                    Rotina {{ $routine?->code }}
                    @if ($routine?->status)
                        <label class="badge bg-success"> ABERTA </label>
                    @else
                        <label class="badge bg-danger"> FINALIZADA </label>
                    @endif
                </div>

                <div class="col-md-4">
                    @if ($routine?->status)
                        @include('livewire.partials.search-form', [
                            'btnNovoLabel' => 'Nova',
                            'btnNovoTitle' => 'Nova Cautela de Arma',
                            'routeSearch' => 'cautions.index',
                            'routeSearchParams' => ['routine_id' => $routine_id],
                            'routeCreate' => 'cautions.create',
                            'routeCreateParams' => ['routine_id' => $routine_id, 'redirect' => 'cautions.index'],
                        ])
                    @else
                        @include('livewire.partials.search-form', [
                            'btnNovoLabel' => 'Nova',
                            'btnNovoTitle' => 'Nova Cautela de Arma',
                            'routeSearch' => 'cautions.index',
                            'routeSearchParams' => ['routine_id' => $routine_id, 'redirect' => 'cautions.index'],
                        ])
                    @endif
                </div>
            </div>
        </div>

        <div class="">
            @include('layouts.msg')

            @include('livewire.cautions.partials.table', ['redirect' => 'cautions.index'])
        </div>
    </div>

    @include('livewire.cautions.partials.receipt', ['caution' => $caution, 'forPrinter' => true])

    @include('partials.button-to-top')
</div>
