
<div>
    <div class="py-4 px-4">
        <div class="">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-0">Ocorrências</h2>
                    Rotina {{ $routine->code }}
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
                </div>
            </div>
        </div>

        <div class="">
            @include('layouts.msg')

            @include('livewire.events.partials.table', ['redirect' => 'events.index'])
        </div>
    </div>

    <div x-data="{ showButton: false }" @scroll.window="showButton = (window.pageYOffset > 100)" class="text-center pb-5 py-4"
        style="position: fixed; bottom: 10px; right: 10px;" x-show="showButton">
        <a href="#" @click.prevent="window.scrollTo({ top: 0, behavior: 'smooth' })" class="btn btn-primary"
            title="Voltar para o topo">
            <i class="fa-solid fa-arrow-up"></i>
        </a>
    </div>
</div>
