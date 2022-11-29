<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="visitor_id">Visitante*</label>
                <select class="form-select" name="visitor_id" id="visitor_id" wire:model.defer="visitor_id" wire:change="find">
                    <option value="">SELECIONE</option>
                    @foreach ($visitors as $key => $visitor)
                        <option value="{{ $visitor->id }}">{{ $visitor->person->full_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="dados-visitante">
        <div class="col-md-3">
            <div class="form-group">
                <label for="certificate_type">Tipo de Porte*</label>
                <select class="form-select" name="certificate_type" id="certificate_type" wire:model.defer="certificate_type">
                    <option value="">SELECIONE</option>
                    <option value="1">PÚBLICO</option>
                    <option value="2">PRIVADO</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="id_card">RG(*)</label>
                <input
                    class="form-control"
                    name="id_card"
                    id="id_card"
                    wire:model.defer="id_card"
                />
            </div>
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
        <div class="col-md-2">
            <label for="certificate_valid_until">Validade Certificado(*)</label>
            <input
                type="date"
                class="form-control text-uppercase"
                name="certificate_valid_until"
                id="certificate_valid_until"
                wire:model.defer="certificate_valid_until"
            >
        </div>
    </div>
</div>
