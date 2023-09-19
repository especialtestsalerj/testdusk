@extends('errors.error')

@section('img')
    <i class="fa fa-exclamation-triangle cog-faint" aria-hidden="true"></i>
@endsection

@section('number')
    400
@endsection

@section('title')
    Erro de requisição
@endsection

@section('message')
    A solicitação do cliente é inválida ou malformada.
@endsection
