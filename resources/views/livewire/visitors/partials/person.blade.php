<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" wire:ignore>
                <label for="visitor_id">Visitante*</label>
                <select class="form-select select2" name="visitor_id" id="visitor_id" @disabled(!$routineStatus) @if(request()->query('disabled')) disabled @endif @if($readonly) readonly @endif>
                    <option value="">SELECIONE</option>
                    @foreach ($visitors as $key => $visitor)
                        <option value="{{ $visitor->id }}" @if($visitor->id == $visitor_id) selected="selected" @endif>
                            {{ $visitor->person->name }} - {{ $visitor->document->documentType->name }}: {{ $visitor->document->numberMaskered }}
                            @if ($visitor->document->state?->initial)
                                - {{ $document->state->initial }}
                            @endif
                        </option>
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
