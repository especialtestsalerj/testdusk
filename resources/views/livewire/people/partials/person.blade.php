<div class="form-group">
    <div class="row">
        <div
            x-init="VMasker($refs.cpf).maskPattern(cpfmask);"
            x-data="{ isEditing: {{formMode() == 'create' ? 'true' : 'false'}}, cpfmask: '999.999.999-99'}"
            @focus-field.window="$refs[$event.detail.field].focus()"
        >
            <div class="col-md-2 d-flex align-items-end">
                <div class="col-md-10">
                    <input name="person_id" id="person_id" type="hidden" wire:model.defer="person_id">

                    <label for="cpf">CPF (Visitante)*</label>
                    <input
                        class="form-control @error('cpf') is-invalid @endError"
                        name="cpf"
                        id="cpf"
                        wire:model.lazy="cpf"
                        x-ref="cpf"
                        onblur="btn_buscar.click()"
                    />
                </div>
                <div class="col-md-2">
                    <button type="button" wire:click="searchCpf" class="btn btn-outline-secondary" id="btn_buscar">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <label for="full_name">Nome (Visitante)*</label>
                <input
                    class="form-control"
                    name="full_name"
                    id="full_name"
                    wire:model.defer="full_name"
                />
            </div>
            <div class="col-md-4">
                <label for="origin">Origem (Visitante)</label>
                <input
                    class="form-control"
                    name="origin"
                    id="origin"
                    wire:model.defer="origin"
                />
            </div>
        </div>
    </div>
</div>
