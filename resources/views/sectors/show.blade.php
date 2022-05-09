@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2> Detalhar Setor</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('sectors.index') }}"> Voltar</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                <div class="form-group">
                    <strong>Nome:</strong>
                    {{ $sector->name }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                <div class="form-group">
                    <strong>Status:</strong>
                    {{ $sector->status }}
                </div>
            </div>
        </div>
    </div>
@endsection
