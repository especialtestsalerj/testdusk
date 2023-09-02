
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row mb-lg-3">
                <div class="col-lg-6">
                    <h3 class="mb-0">Materiais</h3>
                    Rotina {{ $routine->code }}
                    @if ($routine->status)
                        <label class="badge bg-success"> ABERTA </label>
                    @else
                        <label class="badge bg-danger"> FINALIZADA </label>
                    @endif
                </div>

                <div class="col-lg-6">
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
                </div>
            </div>
        </div>

        <div class="p-0">
            @include('layouts.msg')

            @include('livewire.stuffs.partials.table', ['redirect' => 'stuffs.index'])
        </div>
    </div>

    @include('partials.button-to-top')
</div>
