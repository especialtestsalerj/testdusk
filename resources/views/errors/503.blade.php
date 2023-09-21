@extends('errors.error')

@section('img')
    <i class="fa fa-ban cog-faint" aria-hidden="true"></i>
@endsection

@section('number')
    503
@endsection

@section('title')
    Serviço indisponível
@endsection

@section('message')
    O servidor não está disponível para processar a solicitação no momento, geralmente devido a sobrecarga ou manutenção.
@endsection
