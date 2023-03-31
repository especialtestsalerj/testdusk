<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-sm-8 align-self-center">
                <h4 class="mb-0">
                    <i class="fas fa-gun"></i> Armas
                </h4>
            </div>

            <div class="col-sm-4 align-self-center d-flex justify-content-end">
                @if ($routine->status && !$disabled)
                    <button type="button" class="btn btn-primary" wire:click="prepareForCreate" dusk='newWeapon' title="Nova Arma" data-bs-toggle="modal" data-bs-target="#weapon-modal">
                        <i class="fa fa-plus"></i>
                    </button>
                @endif
            </div>

            <!-- Modal -->
            <div wire:ignore.self class="modal fade" id="weapon-modal" tabindex="-1" role="dialog" aria-labelledby="weaponModalLabel" aria-hidden="true">
                <form wire:submit.prevent="store">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="weaponModalLabel">
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
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                    @csrf
                                    <input type="hidden" class="form-control" name="caution_id" id="caution_id" wire:model.defer="caution_id">

                                    @if($modalMode != 'delete')
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <span class="badge bg-warning text-black required-msg">* Campos obrigatórios </span>
                                            </div>
                                        </div>
                                    @endif

                                    @if($modalMode == 'create')
                                        <div class="form-group">
                                            <label for="person_weapon">Lista de Armas do/a Visitante</label>
                                            <select class="form-select" name="person_weapon" id="person_weapon" wire:model="person_weapon" wire:change="find" @disabled($disabled || $readonly)>
                                                <option value=""></option>
                                                @foreach ($personWeapons as $key => $personWeapon)
                                                    <option value="{{ $personWeapon?->id }}">{{ $personWeapon?->weaponType?->name }} - {{ $personWeapon?->weapon_description }} - {{ $personWeapon?->weapon_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="weapon_type_id">Tipo de Arma{{ ($modalMode == 'delete') ? '' : '*' }}</label>
                                        <select class="form-select" name="weapon_type_id" id="weapon_type_id" wire:model.defer="weapon_type_id" @disabled($disabled || $readonly)>
                                            <option value="">SELECIONE</option>
                                            @foreach ($weaponTypes as $key => $weaponType)
                                                @if(((!is_null($cautionWeapon->id)) && (!is_null($cautionWeapon->weapon_type_id) && $cautionWeapon->weapon_type_id === $weaponType->id) || (!is_null(old('weapon_type_id'))) && old('weapon_type_id') == $weaponType->id))
                                                    <option value="{{ $weaponType->id }}" selected="selected">{{ $weaponType->name }}</option>
                                                @else
                                                    <option value="{{ $weaponType->id }}">{{ $weaponType->name }}</option>
                                                @endif
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
                                        <input class="form-control text-uppercase" name="weapon_description" dusk='formWeaponDescription' id="weapon_description" value="{{ is_null(old('weapon_description')) ? $cautionWeapon->weapon_description : old('weapon_description') }}" wire:model.defer="weapon_description" @disabled($disabled || $readonly)/>
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
                                        <input class="form-control text-uppercase" name="weapon_number" id="weapon_number" value="{{ is_null(old('weapon_number')) ? $cautionWeapon->weapon_number : old('weapon_number') }}" wire:model.defer="weapon_number" @disabled($disabled || $readonly)/>
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
                                        <input class="form-control text-uppercase" name="register_number" id="register_number" value="{{ is_null(old('register_number')) ? $cautionWeapon->register_number : old('register_number') }}" wire:model.defer="register_number" @disabled($disabled || $readonly)/>
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
                                                @if(((!is_null($cautionWeapon->id)) && (!is_null($cautionWeapon->cabinet_id) && $cautionWeapon->cabinet_id === $cabinet->id) || (!is_null(old('cabinet_id'))) && old('cabinet_id') == $cabinet->id))
                                                    <option value="{{ $cabinet->id }}" selected="selected">{{ $cabinet->name }}</option>
                                                @else
                                                    <option value="{{ $cabinet->id }}">{{ $cabinet->name }}</option>
                                                @endif
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
                                                @if(((!is_null($cautionWeapon->id)) && (!is_null($cautionWeapon->shelf_id) && $cautionWeapon->shelf_id === $shelf->id) || (!is_null(old('shelf_id'))) && old('shelf_id') == $shelf->id))
                                                    <option value="{{ $shelf->id }}" selected="selected">{{ $shelf->name }}</option>
                                                @else
                                                    <option value="{{ $shelf->id }}">{{ $shelf->name }}</option>
                                                @endif
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
                                    <button type="submit" dusk='submit' class="btn btn-success btn-sm text-white close-modal" title="Salvar" @disabled($disabled || $readonly)><i class="fa fa-save"></i> Salvar</button>
                                @endif
                                @if($modalMode == 'delete')
                                    <button type="button" dusk='submit' wire:click.prevent="delete()" class="btn btn-success btn-sm text-white close-modal" title="Remover"><i class="fa fa-check"></i> Remover</button>
                                @endif
                                <button type="button" dusk='cancel' wire:click.prevent="clearWeapon" class="btn btn-danger btn-sm text-white close-btn" data-bs-dismiss="modal" title="Fechar formulário"><i class="fas fa-ban"></i> Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <table id="cautionWeaponTable" class="table table-striped table-bordered mt-2">
                <thead>
                <tr>
                    <th class="col-md-4">Descrição</th>
                    <th class="col-md-2">Numeração</th>
                    <th class="col-md-2">Registro Sinarm</th>
                    <th class="col-md-2">Localização</th>
                    <th class="col-md-2"></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($cautionWeapons as $weapon)
                    <tr>
                        <td>
                            {{ $weapon?->weaponType?->name }} {{ $weapon?->weapon_description }}
                        </td>
                        <td>
                            {{ $weapon->weapon_number }}
                        </td>
                        <td>
                            {{ $weapon->register_number }}
                        </td>
                        <td>
                            {{ $weapon?->cabinet?->name }} / BOX {{ $weapon?->shelf?->name }}
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id, false }}, {{ true }})" title="Detalhar Arma">
                                <i class="fa fa-search"></i>
                            </button>
                            @if ($routine->status && !$disabled)
                                <button type="button" class="btn btn-link" wire:click="prepareForUpdate({{ $weapon->id }})" title="Alterar Arma">
                                    <i class="fa fa-pencil"></i>
                                </button>

                                <button type="button" class="btn btn-link" wire:click="prepareForDelete({{ $weapon->id }}, {{ true }})" title="Remover Arma">
                                    <i class="fa fa-trash"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-warning mt-2">
                        <i class="fa fa-exclamation-triangle"></i> Nenhuma Arma encontrada.
                    </div>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
