<div>
    <form wire:submit.prevent="finishVisit">
        <div class="container-fluid">
            <h1 class="text-center pt-4">Visitante</h1>

            <div class="text-center pb-4">
                <img src="{{ $visitorPhoto }}" class="rounded" style="max-width: 354px;, max-height:354px;">
            </div>

            <div class="col-md-12 mb-3">

                <label for="name">Nome</label>
                <input value="{{ $name }}" disabled type="name" class="form-control" id="name"
                       aria-describedby="nameHelp">
            </div>

            @can(make_ability_name_with_current_building('visitors:show-via-qr'))
            <div class="col-md-12 mb-3">
                <label for="document">Documento</label>
                <input value="{{ $document->documentType->name ?? '' }} - {{ $document->number ?? '' }}"
                       class="form-control" type="input" name="document" id="document" disabled>
            </div>
            @endcan

            <div class="col-md-12 mb-3">
                <label for="sector">Destino</label>
                <select name="sector" id="sector" class="form-select" disabled>
                    <option selected value="{{ $sector->id ?? '' }}">{{ $sector->name ?? '' }}</option>
                </select>
            </div>

            @can(make_ability_name_with_current_building('visitors:show-via-qr'))
            <div class="form-group">
                <label for="reason">Motivo da Visita</label>
                <textarea class="form-control" id="reason" name="reason" rows="3" disabled>{{ $reason }}</textarea>
            </div>
            @endcan

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="check_in">Entrada</label>
                    <input name="check_in" label="check_in" value="{{ $entranced }}" disabled type="datetime-local"
                           class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="check_out">Saída</label>
                    <input wire:model="exited" name="exited" id="exited" type="datetime-local" class="form-control"
                           @if ($exitedDisabled) disabled @endif>
                </div>
            </div>

            @if ($showSaveButton)
            <div class="text-center">
                <button type="submit" class="btn btn-success text-white ml-1" title="Finalizar Visita">
                    <i class="fa fa-save"></i> Finalizar Visita
                </button>
            </div>
            @endif

        </div>
    </form>
</div>
