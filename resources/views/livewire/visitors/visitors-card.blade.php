<div>
    <form wire:submit.prevent="submit">
        <div class="container-fluid">
            <h1 class="text-center pt-4">Visitante</h1>
            @include('layouts.msg')
            <div class="col-12 pb-3 d-flex justify-content-end">
                <span class="badge bg-warning text-black required-msg"><i class="fa fa-circle-info"></i> * Campos
                    obrigatórios
                </span>
            </div>

            <div class="text-center pb-4">
                <img src="/img/bg.jpg" class="img-thumbnail" style="max-width: 354px;, max-height:472px;">
            </div>

            <div class="col-md-12 mb-3">

                <label for="name" class="form-label">Nome</label>
                <input value="{{ $name }}" disabled type="name" class="form-control" id="exampleInputName"
                    aria-describedby="nameHelp">
            </div>

            <div class="col-md-12 mb-3">
                <label for="name" class="form-label">Documento</label>
                <input value={{ $document }} class="form-control" type="input" name="check_out" id="check_out"
                    disabled>
            </div>

            <div class="col-md-12 mb-3">
                <label for="sector" class="form-label">Setor de Destino</label>
                <select class="form-select" aria-label="Default select example" disabled>
                    <option selected value="{{ $sector }}">Current Sector</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlTextarea1">Motivo da Visita</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{ $reason }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="check_in" class="form-label">Entrada</label>
                    <input value="{{ $entranced }}" disabled type="datetime-local" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="check_out" class="form-label">Saída</label>
                    <input wire:model="exited" name="exited" type="datetime-local" class="form-control">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success text-white ml-1" title="Salvar">
                    <i class="fa fa-save"></i> Finalizar Visita
                </button>
            </div>
        </div>
    </form>
</div>
