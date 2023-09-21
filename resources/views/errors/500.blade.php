@extends('errors.error')

@section('img')
    <i class="fa fa-exclamation-triangle cog-faint" aria-hidden="true"></i>
@endsection

@section('number')
    500
@endsection

@section('title')
    Erro interno do servidor
@endsection

@section('message')
    O servidor encontrou um erro interno e não pode atender à solicitação.
@endsection
