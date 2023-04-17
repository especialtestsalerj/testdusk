<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="visitor_id">Visitante*</label>
                <select class="form-select" name="visitor_id" id="visitor_id" wire:model.defer="visitor_id" wire:change="find" @disabled(!$routineStatus) @if(request()->query('disabled')) disabled @endif @if($readonly) readonly @endif>
                    <option value="">SELECIONE</option>
                    @foreach ($visitors as $key => $visitor)
                        <option value="{{ $visitor->id }}" @if($visitor->id == $visitor_id) selected="selected" @endif>{{ $visitor->person->full_name }}</option>
                    @endforeach
                </select>
                <div>
                    @error('msg_visitor')
                    <small class="text-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        {{ $message }}
                    </small>
                    @endError
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="certificate_type">Tipo de Porte*</label>
                <select class="form-select" name="certificate_type" id="certificate_type" wire:model="certificate_type" @disabled(!$routineStatus) @if(request()->query('disabled')) disabled @endif @if($readonly) readonly @endif>
                    <option value="">SELECIONE</option>
                    <option value="1">PÚBLICO</option>
                    <option value="2">PRIVADO</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="id_card">RG{{ ($certificate_type == 2) ? '*' : '' }}</label>
                <input
                    type="text"
                    class="form-control"
                    name="id_card"
                    id="id_card"
                    wire:model.defer="id_card"
                    @disabled(!$routineStatus) @if(request()->query('disabled')) disabled @endif @if($readonly) readonly @endif
                />
            </div>
        </div>
        <div class="col-md-4">
            <label for="certificate_number">Núm. Certificado{{ ($certificate_type == 2) ? '*' : '' }}</label>
            <input
                type="text"
                class="form-control"
                name="certificate_number"
                id="certificate_number"
                wire:model.defer="certificate_number"
                @disabled(!$routineStatus) @if(request()->query('disabled')) disabled @endif @if($readonly) readonly @endif
            />
        </div>
        <div class="col-md-2">
            <label for="certificate_valid_until">Validade Certificado{{ ($certificate_type == 2) ? '*' : '' }}</label>
            <input
                type="date"
                class="form-control text-uppercase"
                name="certificate_valid_until"
                id="certificate_valid_until"
                wire:model.defer="certificate_valid_until"
                @disabled(!$routineStatus) @if(request()->query('disabled')) disabled @endif @if($readonly) readonly @endif
            >
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label for="destiny_sector_name">Destino</label>
            <input
                type="text"
                class="form-control text-uppercase"
                name="destiny_sector_name"
                id="destiny_sector_name"
                wire:model.defer="destiny_sector_name"
                @disabled(true)
            >
        </div>
    </div>
</div>
