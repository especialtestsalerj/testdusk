<div class="form-group">
    <div class="row">
        <div class="col-md-2 d-flex align-items-end">
            <div class="col-md-10">
                <input name="person_id" id="person_id" type="hidden" wire:model.defer="person_id">

                <label for="cpf">CPF (Visitante)*</label>
                <input
                    class="form-control @error('cpf') is-invalid @endError"
                    name="cpf"
                    id="cpf"
                    wire:model.lazy="cpf"
                    onblur="btn_buscar.click()"
                    value="{{is_null(old('cpf')) ?
                        isset($visitor?->person) ? $visitor->person->cpf : (isset($caution?->person) ? $caution->person->cpf : old('cpf'))
                        : old('cpf')}}"
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
                value="{{is_null(old('full_name')) ? $visitor->full_name : old('full_name')}}"
            />
        </div>
        <div class="col-md-4">
            <label for="origin">Origem (Visitante)</label>
            <input
                class="form-control"
                name="origin"
                id="origin"
                wire:model.defer="origin"
                value="{{is_null(old('origin')) ? $visitor->origin : old('origin')}}"
            />
        </div>
    </div>
</div>
