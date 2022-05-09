@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Alteração de Tipo de Ocorrência</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('event_types.index') }}"> Voltar</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('event_types.update',$eventType->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-1">
                    <div class="form-group">
                        <strong>Nome:</strong>
                        <input type="text" name="name" value="{{ $eventType->name }}" class="form-control" placeholder="Nome">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-1">
                    <div class="form-group">
                        <strong>Status:</strong>
                        <textarea class="form-control" style="height:150px" name="status" placeholder="Status">{{ $eventType->status }}</textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
