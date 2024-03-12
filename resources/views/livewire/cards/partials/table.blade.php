<div>

    <div class="row">

        @forelse ($cards as $card)
            <div class="col-md-6 col-lg-4 col-xxl-3 mb-2">
                <div class="card bg-white">
                    <div class="card-header bg-blue-light text-white">
                        <div class="row d-flex align-items-center">
                            <div class="col fw-bolder d-inline-block d-inline-block text-truncate">
                                <div data-label="Visitante">
                                    {{$card->number}}

                                    @if ($card->status)
                                        <label class="badge bg-success"> ATIVO </label>
                                    @else
                                        <label class="badge bg-danger"> INATIVO </label>
                                    @endif

                                </div>

                            </div>

                            <div class="col-4 text-end">
                                @if($card->visitors->first())
                                    @can(make_ability_name_with_current_building('visitors:checkout'))
                                        <span class="btn btn-primary px-1 py-0 btn-visit-action"
                                              wire:click="prepareForCheckout({{ $card->visitors->first()->id }})"
                                              title="Registrar Saída">
                                                <i class="fa fa-lg fa-arrow-up-right-from-square"></i>
                                            </span>
                                    @endCan
                                @endif
                                @can(make_ability_name_with_current_building('cards:update'))
                                    <a class="text-white" href="{{ route('cards.show', ['id' => $card->id]) }}"
                                       title="Alterar"><i class="fa fa-lg fa-pencil"></i></a>
                                @endCan
                            </div>
                        </div>
                    </div>
                    @if ($card->visitors->first())
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 d-flex flex-column visitor-data">


                                    <div class="row mt-0">
                                        <div class="col-12 text-center text-lg-start">
                                            <div class="fw-bold small">Visitante</div>
                                            <div class="lead fw-bold">
                                                {{ convert_case($card->visitors->first()->person->name, MB_CASE_UPPER) }}
                                            </div>

                                        </div>

                                    </div>


                                    <div class="row d-flex align-items-center mt-3">
                                        <div class="col-6 text-center text-lg-start">
                                            <span class="fw-bold">Entrada:</span>
                                            {{ convert_case($card->visitors->first()?->entranced_at?->format('d/m/Y H:i') , MB_CASE_UPPER) }}
                                        </div>

                                        <div class="col-6 text-center text-lg-start" data-label="Saída">
                                            <span class="fw-bold"> Saída: </span>
                                            <span class="badge bg-warning text-black">EM ABERTO</span>
                                        </div>

                                        <div class="col-12 text-center text-lg-start">
                                            <span class="fw-bold">Destino:</span> <br>
                                            @foreach($card?->visitors?->first()?->sectors as $sector)
                                                {{$sector->name}} <br>
                                            @endforeach
                                        </div>

                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12 text-center text-lg-start">
                                            <span class="fw-bold">Visitante possui restrição de acesso:</span>
                                            @if($this->hasRestriction($card))
                                                <span class="badge bg-danger py-2 px-3">SIM</span>
                                            @else
                                                <span class="badge bg-success py-2 px-3">NÃO</span>
                                            @endif

                                            <button
                                                wire:click="createRestriction({{ $card?->visitors?->first()?->person->id }})"
                                                data-bs-toggle="modal" data-bs-target="#restriction-modal"
                                                title="Nova Restrição" type="button"
                                                class="btn btn-sm btn-primary ms-2">
                                                <strong>
                                                    <i class="fa fa-xl fa-plus"></i>
                                                </strong>
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="row">
                                <div class="col-7 d-flex flex-column visitor-data">
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <div class="row d-flex align-items-center">
                                                <div class="col-12 d-flex justify-content-start">
                                                    <div data-label="Destino"
                                                         class="badge text-truncate rounded-pill bg-secondary mb-1">
                                                        {{$card->building->name}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-warning mt-2">
                <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhum Cartão encontrado.
            </div>
        @endforelse

        <div class="d-flex justify-content-center mt-4">
            {{ $cards->links() }}
        </div>

        <livewire:person-restrictions.modal-form :readonlyBuilding="true"/>

    </div>

</div>
