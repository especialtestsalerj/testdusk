<div>
    <form wire:submit.prevent="endVisit">
        <div class="container-fluid">
            <h1 class="text-center pt-4">Visitante</h1>

            <div class="col-12 pb-3 d-flex justify-content-end">
                <span class="badge bg-warning text-black required-msg"><i class="fa fa-circle-info"></i> * Campos
                    obrigatórios
                </span>
            </div>

            <div class="text-center pb-4">
                <img src="/img/bg.jpg" class="rounded" style="max-width: 354px;, max-height:472px;">
            </div>

            <div class="col-md-12 mb-3">

                <label for="name">Nome</label>
                <input value="{{ $name }}" disabled type="name" class="form-control" id="name"
                    aria-describedby="nameHelp">
            </div>

            <div class="col-md-12 mb-3">
                <label for="document">Documento</label>
                <input value={{ $document }} class="form-control" type="input" name="document" id="document"
                    disabled>
            </div>

            <div class="col-md-12 mb-3">
                <label for="sector">Setor de Destino</label>
                <select name="sector" id="sector" class="form-select" disabled>
                    <option selected value="{{ $sector }}">{{ $sector }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="reason">Motivo da Visita</label>
                <textarea class="form-control" id="reason" name="reason" rows="3" disabled>{{ $reason }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="check_in">Entrada</label>
                    <input name="check_in" label="check_in" value="{{ $entranced }}" disabled type="datetime-local"
                        class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="check_out">Saída</label>
                    <input wire:model="exited" value="{{$exited}}" name="exited" id="exited" type="datetime-local"
                        class="form-control">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success text-white ml-1" title="Finalizar Visita">
                    <i class="fa fa-save"></i> Finalizar Visita
                </button>

            </div>
        </div>
    </form>
</div>
