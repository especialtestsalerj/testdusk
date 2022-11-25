<div class="form-group">
    <div
        x-init="VMasker($refs.cpf).maskPattern(cpfmask);"
        x-data="{ isEditing: {{formMode() == 'create' ? 'true' : 'false'}}, cpfmask: '999.999.999-99'}"
        @focus-field.window="$refs[$event.detail.field].focus()"
    >
        <div class="row">
            <div class="col-md-2 d-flex align-items-end">
                <div class="col-md-12">
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

                    <label for="visitor_id">Visitante*</label>
                    <select class="select2" name="visitor_id" id="visitor_id" onchange="find">
                        <option value="">SELECIONE</option>
                        @foreach ($visitors as $key => $visitor)
                            @if(((!is_null($caution->id)) && (!is_null($caution->visitor_id) && $caution->visitor_id === $visitor->id) || (!is_null(old('visitor_id'))) && old('visitor_id') == $visitor->id))
                                <option value="{{ $visitor->id }}" selected="selected">{{ $visitor->id }}</option>
                            @else
                                <option value="{{ $visitor->id }}">{{ $visitor->person->full_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <label for="certificate_type">Tipo de Porte*</label>
                <select class="select2" name="certificate_type" id="certificate_type" wire:model.defer="certificate_type">
                    <option value="">SELECIONE</option>
                    <option value="1">PÚBLICO</option>
                    <option value="2">PRIVADO</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="id_card">RG(*)</label>
                <input
                    class="form-control"
                    name="id_card"
                    id="id_card"
                    wire:model.defer="id_card"
                />
            </div>
            <div class="col-md-4">
                <label for="certificate_number">Núm. Certificado(*)</label>
                <input
                    class="form-control"
                    name="certificate_number"
                    id="certificate_number"
                    wire:model.defer="certificate_number"
                />
            </div>
            <div class="col-md-4">
                <label for="certificate_valid_until">Validade Certificado(*)</label>
                <input
                    type="datetime-local"
                    max="3000-01-01T23:59"
                    class="form-control text-uppercase"
                    name="certificate_valid_until"
                    id="certificate_valid_until"
                    wire:model.defer="certificate_valid_until"
                >
            </div>
        </div>
    </div>
</div>
