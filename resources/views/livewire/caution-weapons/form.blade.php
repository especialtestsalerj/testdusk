<div class="row">
    <div class="col-md-12 px-3">
        <div class="row mb-3">
            <div class="col-sm-8 align-self-center">
                <h3 class="mb-0">
                    <i class="fas fa-gun"></i> Armas
                </h3>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if ($routine->status && !$disabled && !isset($this->caution?->old_id))
                    <button type="button" class="btn btn-primary" wire:click="prepareForCreate" id='newWeapon' title="Nova Arma" data-bs-toggle="modal" data-bs-target="#weapon-modal">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
            </div>

            @include('livewire.caution-weapons.modal')
            
        </div>

        <div class="row">
            @forelse ($cautionWeapons as $weapon)
                <div class="cards-striped mx-lg-0 mt-lg-2">
                    <div class="card">
                        <div class="card-body py-1">
                            <div class="row d-flex align-items-center">
                                <div class="col-12 col-lg-6 text-center text-lg-start">
                                    <span class="fw-bold">Descrição:</span> {{ $weapon?->weaponType?->name }} {{ $weapon?->weapon_description }}
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                    <span class="fw-bold">Numeração:</span> {{ $weapon?->weapon_number ?? '-' }}
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                    <span class="fw-bold">Registro Sinarm:</span> {{ $weapon?->register_number ?? '-' }}
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                    <span class="fw-bold">Entrada:</span> {{ $weapon?->entranced_at?->format('d/m/Y \À\S H:i') ?? '-' }}
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                    <span class="fw-bold">Saída:</span> @if(isset($weapon?->exited_at)) {{ $weapon?->exited_at?->format('d/m/Y \À\S H:i') }} @else <span class="badge bg-warning text-black">PENDENTE</span> @endif
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                    <span class="fw-bold">Localização:</span> {{ $weapon?->cabinet?->name }} / BOX {{ $weapon?->shelf?->name }}
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-end">
                                    @if (isset($weapon?->old_id))
                                        <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR</span>
                                    @endif
                                    <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id }}, {{ true }})" title="Detalhar Arma">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    @if ($routine->status && !$disabled)
                                        <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id }})" title="Alterar Arma" id="editWeapon{{ $weapon->id }}">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        @if (!isset($weapon?->old_id))
                                            <button type="button" class="btn btn-link" wire:click="prepareForDelete({{ $weapon->id }}, {{ true }})" title="Remover Arma" id="removeWeapon{{ $weapon->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i> Nenhuma Arma encontrada.
                    </div>
                </div>
            @endforelse
            <div class="d-flex justify-content-center">

            </div>
        </div>
    </div>
</div>
