<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h3 class="mb-0">
                    <i class="fas fa-gun"></i> Armas
                </h3>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if ($routine->status && !$disabled && !isset($this->caution?->old_id))
                    <button type="button" class="btn btn-sm btn-primary text-white" wire:click="prepareForCreate" id='newWeapon' title="Nova Arma" data-bs-toggle="modal" data-bs-target="#weapon-modal">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
            </div>


            @include('livewire.caution-weapons.modal')

            {{--
            @include('')
            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="weapon-modal" tabindex="-1" role="dialog" aria-labelledby="weaponModalLabel" aria-hidden="true">
                <form wire:submit.prevent="store">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="weaponModalLabel">
                                    @switch($modalMode)
                                        @case('create')
                                            <i class="fa fa-plus"></i> Nova Arma
                                            @break
                                        @case('update')
                                            <i class="fa fa-pencil"></i> Alteração de Arma
                                            @break
                                        @case('delete')
                                            <i class="fa fa-trash"></i> Remoção de Arma
                                            @break
                                        @default
                                            <i class="fa fa-gun"></i> Arma
                                    @endswitch
                                </h5>
                                @if($modalMode == 'update')
                                    @if (isset($this->old_id))
                                        &nbsp;<span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR</span>
                                    @endif
                                @endif
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    @csrf
                                    <input type="hidden" class="form-control" name="caution_id" id="caution_id" wire:model.defer="caution_id">

                                    @if($modalMode != 'delete')
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <span class="badge bg-info text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if($modalMode == 'create' && count($personWeapons) > 0)
                                        <div class="form-group">
                                            <label for="person_weapon">Lista de Armas do/a Visitante</label>
                                            <select class="form-select" name="person_weapon" id="person_weapon" wire:model="person_weapon" wire:change="find" @disabled($disabled || $readonly)>
                                                <option value="">&nbsp;</option>
                                                @foreach ($personWeapons as $key => $personWeapon)
                                                    <option value="{{ $personWeapon?->id }}">{{ $personWeapon?->weaponType?->name }} - {{ $personWeapon?->weapon_description }} - {{ $personWeapon?->weapon_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="entranced_at">Entrada*</label>
                                                <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="entranced_at" id="entranced_at" wire:model.defer="entranced_at" @disabled($disabled || $readonly) @readonly(isset($this->old_id))/>
                                                <div>
                                                    @error('entranced_at')
                                                        <small class="text-danger">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </small>
                                                    @endError
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exited_at">Saída</label>
                                                <input type="datetime-local" max="3000-01-01T23:59" class="form-control text-uppercase" name="exited_at" id="exited_at" wire:model.defer="exited_at" @disabled($disabled || $readonly)/>
                                                <div>
                                                    @error('exited_at')
                                                        <small class="text-danger">
                                                            <i class="fas fa-exclamation-triangle"></i>
                                                            {{ $message }}
                                                        </small>
                                                    @endError
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="weapon_type_id">Tipo de Arma{{ ($modalMode == 'delete') ? '' : '*' }}</label>
                                        <select class="form-select" name="weapon_type_id" id="weapon_type_id" wire:model.defer="weapon_type_id" @disabled($disabled || $readonly) @readonly(isset($this->old_id))>
                                            <option value="">SELECIONE</option>
                                            @foreach ($weaponTypes as $key => $weaponType)
                                                <option value="{{ $weaponType->id }}">{{ $weaponType->name }}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            @error('weapon_type_id')
                                                <small class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </small>
                                            @endError
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="weapon_description">Descrição da Arma{{ ($modalMode == 'delete') ? '' : '*' }}</label>
                                        <input type="text" class="form-control text-uppercase" name="weapon_description" dusk='formWeaponDescription' id="weapon_description" wire:model.defer="weapon_description" @disabled($disabled || $readonly) @readonly(isset($this->old_id))/>
                                        <div>
                                            @error('weapon_description')
                                                <small class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </small>
                                            @endError
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="weapon_number">Numeração da Arma{{ ($modalMode == 'delete') ? '' : '*' }}</label>
                                        <input type="text" class="form-control text-uppercase" name="weapon_number" id="weapon_number" wire:model.defer="weapon_number" @disabled($disabled || $readonly) @readonly(isset($this->old_id))/>
                                        <div>
                                            @error('weapon_number')
                                                <small class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </small>
                                            @endError
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="register_number">Número de Registro (Sinarm)</label>
                                        <input type="text" class="form-control text-uppercase" name="register_number" id="register_number" wire:model.defer="register_number" @disabled($disabled || $readonly) @readonly(isset($this->old_id))/>
                                        <div>
                                            @error('register_number')
                                                <small class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </small>
                                            @endError
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cabinet_id">Armário{{ ($modalMode == 'delete') ? '' : '*' }}</label>
                                        <select class="form-select" name="cabinet_id" id="cabinet_id" wire:model.defer="cabinet_id" @disabled($disabled || $readonly)>
                                            <option value="">SELECIONE</option>
                                            @foreach ($cabinets as $key => $cabinet)
                                                <option value="{{ $cabinet->id }}">{{ $cabinet->name }}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            @error('cabinet_id')
                                                <small class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </small>
                                            @endError
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="shelf_id">Box{{ ($modalMode == 'delete') ? '' : '*' }}</label>
                                        <select class="form-select" name="shelf_id" id="shelf_id" wire:model.defer="shelf_id" @disabled($disabled || $readonly)>
                                            <option value="">SELECIONE</option>
                                            @foreach ($shelves as $key => $shelf)
                                                <option value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            @error('shelf_id')
                                                <small class="text-danger">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    {{ $message }}
                                                </small>
                                            @endError
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                @if($modalMode != 'delete')
                                    <button type="submit" dusk='submit' class="btn btn-success btn-sm text-white close-modal" title="Salvar" @disabled($disabled || $readonly) id="salvarWeapon"><i class="fa fa-save"></i> Salvar</button>
                                @endif

                                @if($modalMode == 'delete')
                                    <div>
                                        <button dusk='delete' wire:click.prevent="delete" class="btn btn-success btn-sm text-white close-modal" title="Remover" id="removerWeapon"><i class="fas fa-check"></i> Remover</button>
                                    </div>
                                @endif

                                <div>
                                    <button type="button" dusk='cancel' wire:click.prevent="clearWeapon" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal" title="Fechar formulário"><i class="fas fa-ban"></i> Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            --}}
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
                                        <i class="fa fa-lg fa-search"></i>
                                    </button>
                                    @if ($routine->status && !$disabled)
                                        <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id }})" title="Alterar Arma" id="editWeapon{{ $weapon->id }}">
                                            <i class="fa fa-lg fa-pencil"></i>
                                        </button>
                                        @if (!isset($weapon?->old_id))
                                            <button type="button" class="btn btn-link" wire:click="prepareForDelete({{ $weapon->id }}, {{ true }})" title="Remover Arma" id="removeWeapon{{ $weapon->id }}">
                                                <i class="fa fa-lg fa-trash"></i>
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
                    <div class="alert alert-warning mt-2">
                        <i class="fa fa-lg fa-exclamation-triangle"></i> Nenhuma Arma encontrada.
                    </div>
                </div>
            @endforelse
            <div class="d-flex justify-content-center">

            </div>
        </div>
    </div>
</div>
