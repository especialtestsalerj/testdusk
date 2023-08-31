<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h3 class="mb-0">
                    <i class="fas fa-id-card"></i> Documentos
                </h3>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if (!$disabled)
                    <button type="button" class="btn btn-primary" wire:click="prepareForCreate" id='newDocument' title="Novo Documento" data-bs-toggle="modal" data-bs-target="#document-modal">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
                @if(isset($this->caution?->old_id))
                    <span class="badge bg-warning text-black required-msg"><i class="fa fa-circle-info"></i> Só é permitido incluir armas em cautelas da rotina atual. Recomendamos que abra nova visita e cautela para esse/a visitante </span>
                @endif
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="document-modal" tabindex="-1" role="dialog" aria-labelledby="documentModalLabel" aria-hidden="true">
                <form wire:submit.prevent="store">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="documentModalLabel">
                                    @switch($modalMode)
                                        @case('create')
                                            <i class="fas fa-plus"></i> Nova Arma
                                            @break
                                        @case('update')
                                            <i class="fas fa-pencil"></i> Alteração de Arma
                                            @break
                                        @case('delete')
                                            <i class="fas fa-trash"></i> Remoção de Arma
                                            @break
                                        @default
                                            <i class="fas fa-gun"></i> Arma
                                    @endswitch
                                </h5>
                                @if($modalMode == 'update')
                                    @if (isset($this->old_id))
                                        &nbsp;<span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR </span>
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

                                    <div class="form-group">
                                        <label for="weapon_type_id">Tipo de Documento{{ ($modalMode == 'delete') ? '' : '*' }}</label>
                                        <select class="form-select" name="weapon_type_id" id="weapon_type_id" wire:model.defer="weapon_type_id" @disabled($disabled || $readonly)>
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
                                        <input class="form-control text-uppercase" name="weapon_description" dusk='formWeaponDescription' id="weapon_description" wire:model.defer="weapon_description" @disabled($disabled || $readonly)/>
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
                                        <input class="form-control text-uppercase" name="weapon_number" id="weapon_number" wire:model.defer="weapon_number" @disabled($disabled || $readonly)/>
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
                                        <input class="form-control text-uppercase" name="register_number" id="register_number" wire:model.defer="register_number" @disabled($disabled || $readonly)/>
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
                                    <span class="fw-bold">Saída:</span> @if(isset($weapon?->exited_at)) {{ $weapon?->exited_at?->format('d/m/Y \À\S H:i') }} @else <span class="badge bg-warning text-black">PENDENTE </span> @endif
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-start">
                                    <span class="fw-bold">Localização:</span> {{ $weapon?->cabinet?->name }} / BOX {{ $weapon?->shelf?->name }}
                                </div>
                                <div class="col-12 col-lg-3 text-center text-lg-end">
                                    @if (isset($weapon?->old_id))
                                        <span class="badge bg-warning text-black"><i class="fa fa-exclamation-triangle"></i> ROTINA ANTERIOR </span>
                                    @endif
                                    <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id, false }}, {{ true }})" title="Detalhar Arma">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    @if ($routine->status && !$disabled)
                                        <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id }})" title="Alterar Arma" id="editWeapon">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        @if (!isset($weapon?->old_id))
                                            <button type="button" class="btn btn-link" wire:click="prepareForDelete({{ $weapon->id }}, {{ true }})" title="Remover Arma" id="removeWeapon">
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
