<div>
    <div class="modal-body">
        <form>
            <input type="hidden" class="form-control" name="caution_id" id="caution_id" wire:model.defer="caution_id">

            <p class="text-end">* Campos obrigatórios</p>

            <div class="form-group">
                <label for="weapon_type_id">Tipo de Arma*</label>
                <select class="form-control select2" name="weapon_type_id" id="weapon_type_id" value="{{is_null(old('weapon_type_id')) ? $cautionWeapon->weapon_type_id : old('weapon_type_id')}}" wire:model.defer="weapon_type_id">
                    <option value="">SELECIONE</option>
                    @foreach ($users as $key => $user)
                        @if(((!is_null($cautionWeapon->id)) && (!is_null($cautionWeapon->weapon_type_id) && $cautionWeapon->weapon_type_id === $user->id) || (!is_null(old('weapon_type_id'))) && old('weapon_type_id') == $user->id))
                            <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                <label for="description">Descrição da Arma*</label>
                <input class="form-control" name="description" id="description" value="{{is_null(old('description')) ? $cautionWeapon->description : old('description')}}" wire:model.defer="description"/>
                <div>
                    @error('description')
                    <small class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </small>
                    @endError
                </div>
            </div>
            <div class="form-group">
                <label for="weapon_number">Numeração da Arma*</label>
                <input class="form-control" name="weapon_number" id="weapon_number" value="{{is_null(old('weapon_number')) ? $cautionWeapon->weapon_number : old('weapon_number')}}" wire:model.defer="weapon_number"/>
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
                <label for="cabinet_id">Armário*</label>
                <select class="form-control select2" name="cabinet_id" id="cabinet_id" value="{{is_null(old('cabinet_id')) ? $cautionWeapon->cabinet_id : old('cabinet_id')}}" wire:model.defer="cabinet_id">
                    <option value="">SELECIONE</option>
                    @foreach ($users as $key => $user)
                        @if(((!is_null($cautionWeapon->id)) && (!is_null($cautionWeapon->cabinet_id) && $cautionWeapon->cabinet_id === $user->id) || (!is_null(old('cabinet_id'))) && old('cabinet_id') == $user->id))
                            <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
                <label for="shelf_id">Box*</label>
                <select class="form-control select2" name="shelf_id" id="shelf_id" value="{{is_null(old('shelf_id')) ? $cautionWeapon->shelf_id : old('shelf_id')}}" wire:model.defer="shelf_id">
                    <option value="">SELECIONE</option>
                    @foreach ($users as $key => $user)
                        @if(((!is_null($cautionWeapon->id)) && (!is_null($cautionWeapon->shelf_id) && $cautionWeapon->shelf_id === $user->id) || (!is_null(old('shelf_id'))) && old('shelf_id') == $user->id))
                            <option value="{{ $user->id }}" selected="selected">{{ $user->name }}</option>
                        @else
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
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
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" wire:click.prevent="store()" class="btn btn-outline-success btn-sm close-modal"><i class="fa fa-save"></i> Salvar</button>
        <button type="button" wire:click.prevent="clearWeapon" class="btn btn-outline-danger btn-sm close-btn" data-bs-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
    </div>
</div>
