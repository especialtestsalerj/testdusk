@extends('errors.error')

@section('img')
    <i class="fa fa-exclamation-triangle cog-faint" aria-hidden="true"></i>
@endsection

@section('number')
    502
@endsection

@section('title')
    Erro de gateway
@endsection

@section('message')
    O servidor atuou como um gateway ou proxy e recebeu uma resposta inválida do servidor upstream.
@endsection
