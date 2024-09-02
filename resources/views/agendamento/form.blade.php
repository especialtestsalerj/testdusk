@extends('layouts.booking-talwind')

@section('content')

    <livewire:agendamento.form :building_id="$building_id" />
@endsection
