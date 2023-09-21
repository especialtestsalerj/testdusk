@extends('errors.error')

@section('img')
    <i class="fa fa-ban cog-faint" aria-hidden="true"></i>
@endsection

@section('number')
    403
@endsection

@section('title')
    Acesso não autorizado
@endsection

@section('message')
    Você não tem permissão para acessar a página solicitada.
@endsection
