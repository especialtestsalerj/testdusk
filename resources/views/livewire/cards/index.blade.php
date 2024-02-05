<div>
    <div class="py-4 px-4">
        <div>

            <div class="row">
                <div class="col-md-4">
                    <h3 class="mb-0"><i class="fa fa-id-card"></i> Cartões</h3>
                </div>

                <div class="col-md-8 align-self-right text-end pb-3">

                    <button wire:click="disableAllCards" type="button" class="btn btn-secondary text-white float-right"  title="Desabilitar todos os cartões" dusk="DisableAllCards">
                        <i class="fa fa-check-double"></i> Desabilitar todos os cartões
                    </button>

                    <button wire:click="enableAllCards" type="button" class="pr-2 btn btn-secondary text-white"  title="Desabilitar todos os cartões" dusk="DisableAllCards">
                        <i class="fa fa-check-double"></i> Habilitar todos os cartões
                    </button>

                </div>


                <div class="col-md-9">
                    @include(
                        'livewire.partials.search-form',
                        [
                            'btnNovoLabel' => 'Novo',
                            'btnNovoTitle' => 'Novo Cartão',
                            'routeSearch' => 'cards.index',
                            'routeCreate' => 'cards.create',
                        ]
                    )
                </div>

                <div class="col-md-3 mt-lg-0 text-center">
                    <span class="fw-bold btn btn-outline-secondary">
                        <input type="checkbox" name="openedExitFilter"
                               wire:model="hasVisitor"><span class="ms-2">Cartões com visita em aberto</span>
                    </span>
                </div>


            </div>
        </div>

        <div class="p-0">
            @include('layouts.msg')

            @include('livewire.cards.partials.table')
        </div>
    </div>

    @include('partials.button-to-top')
</div>
