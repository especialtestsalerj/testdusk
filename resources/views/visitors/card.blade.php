@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1 class="text-center pt-4">Visitante</h1>
        <div class="col-12 pb-3 d-flex justify-content-end">
            <span class="badge bg-warning text-black required-msg"><i class="fa fa-circle-info"></i> * Campos obrigatórios
            </span>
        </div>

        <div class="text-center pb-4">
            <img src="/img/bg.jpg" class="img-thumbnail" style="max-width: 354px;, max-height:472px;">
        </div>

        <div class="col-md-12 mb-3">

            <label for="name" class="form-label">Nome</label>
            <input disabled type="name" class="form-control" id="exampleInputName" aria-describedby="nameHelp">
        </div>

        <div class="col-md-12 mb-3">
            <label for="name" class="form-label">Documento</label>
            <input class="form-control" type="input" name="check_out" id="check_out" disabled>
        </div>

        <div class="col-md-12 mb-3">
            <label for="name" class="form-label">Setor de Destino</label>
            <select class="form-select" aria-label="Default select example" disabled>
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleFormControlTextarea1">Motivo da Visita</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="check_in" class="form-label">Entrada</label>
                <input disabled type="datetime-local" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="col-md-6 mb-3">
                <label for="check_out" class="form-label">Saída</label>
                <input type="datetime-local" class="form-control" id="exampleInputPassword1">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-success text-white ml-1" id="submitButton" title="Salvar">
                <i class="fa fa-save"></i> Finalizar Visita
            </button>
        </div>
    </div>
@endsection
