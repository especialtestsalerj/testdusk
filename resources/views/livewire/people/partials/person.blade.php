<div class="form-group">
    <div
        x-init="VMasker($refs.cpf).maskPattern(cpfmask);"
        x-data="{ isEditing: {{ !$modal ? 'true' : 'false' }}, cpfmask: '999.999.999-99'}"
        @focus-field.window="$refs[$event.detail.field].focus()"
    >
        <div class="row">

            <div class="form-group">

                <div class="col-md-12 d-flex align-items-end">
                    <div class="col-md-4">
                        <input name="person_id" id="person_id" type="hidden" wire:model.defer="person_id">
                        <label for="cpf">CPF (Visitante)*</label>
                        <input
                            type="text"
                            class="form-control @error('cpf') is-invalid @endError"
                            name="cpf"
                            id="cpf"
                            wire:model.lazy="cpf"
                            x-ref="cpf"
                            onblur="btn_buscar.click()"
                            @if($modal) disabled @endif @if($readonly) readonly @endif
                        />
                    </div>
                    <div class="col-md-2">
                        <button type="button" wire:click="searchCpf" class="btn btn-outline-secondary" id="btn_buscar" @if($modal || $readonly) disabled @endif>
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                    <div class="col-md-6">
                        <label class="block mb-4">
                            <span class="sr-only">Choose File</span>
                            <input type="file" name="image"
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                            @error('image')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </label>
                    </div>
                </div>

            </div>

        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-md-12">
                    <label for="full_name">Nome (Visitante)*</label>
                    <input
                        type="text"
                        class="form-control"
                        name="full_name"
                        id="full_name"
                        wire:model.defer="full_name"
                        @if($modal) disabled @endif @if($readonly) readonly @endif
                    />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">

                <div class="col-md-12">
                    <label for="origin">Origem (Visitante)</label>
                    <input
                        type="text"
                        class="form-control"
                        name="origin"
                        id="origin"
                        wire:model.defer="origin"
                        @if($modal) disabled @endif @if($readonly) readonly @endif
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @error('cpf')
        <small class="text-danger">
            <i class="fas fa-exclamation-triangle"></i>
            {{ $message }}
        </small>
        @endError

        @foreach($alerts as $alert)
            <small class="text-danger">
                <i class="fas fa-cancel"></i>
                {{ $alert }}
            </small>
        @endforeach
    </div>
</div>
