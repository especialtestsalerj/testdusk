<div class="form-group">
    <div
        x-init="VMasker($refs.cpf).maskPattern(cpfmask);"
        x-data="{ isEditing: {{ !$modal ? 'true' : 'false' }}, cpfmask: '999.999.999-99'}"
        @focus-field.window="$refs[$event.detail.field].focus()"
    >
        <div class="row">
            @if($modal)
            <div class="form-group">
            @endif
            <div class="@if($modal) col-md-12 @else col-md-3 @endif d-flex align-items-end">
                <div class="col-md-10">
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
                        @disabled(!$routineStatus) @if($modal) disabled @endif @if($readonly) readonly @endif
                    />
                </div>
                <div class="col-md-2">
                    <button type="button" wire:click="searchCpf" class="btn btn-outline-secondary" id="btn_buscar" @disabled(!$routineStatus) @if($modal || $readonly) disabled @endif>
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            @if($modal)
            </div>
            <div class="form-group">
            @endif
            <div class="@if($modal) col-md-12 @else col-md-5 @endif">
                <label for="full_name">Nome (Visitante)*</label>
                <input
                    type="text"
                    class="form-control"
                    name="full_name"
                    id="full_name"
                    wire:model.defer="full_name"
                    @disabled(!$routineStatus) @if($modal) disabled @endif @if($readonly) readonly @endif
                />
            </div>
            @if($modal)
            </div>
            @endif
            <div class="@if($modal) col-md-12 @else col-md-4 @endif">
                <label for="origin">Origem (Visitante)</label>
                <input
                    type="text"
                    class="form-control"
                    name="origin"
                    id="origin"
                    wire:model.defer="origin"
                    @disabled(!$routineStatus) @if($modal) disabled @endif @if($readonly) readonly @endif
                />
            </div>
        </div>
    </div>
</div>
