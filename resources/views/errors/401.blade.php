@extends('errors.error')

@section('img')
    <i class="fa fa-exclamation-triangle cog-faint" aria-hidden="true"></i>
@endsection

@section('number')
    401
@endsection

@section('title')
    Acesso sem autenticação
@endsection

@section('message')
    O acesso ao recurso requer autenticação.
@endsection
