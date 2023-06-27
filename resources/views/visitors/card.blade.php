@extends('layouts.app')
@section('content')
<div>
    <h1>Visitante</h1>

    @csrf
    <label for="name">Nome do Visitante:</label>
    <input type="text" name="name" id="name" required>

    <label for="check_in">Entrada:</label>
    <input type="datetime-local" name="check_in" id="check_in" required>

    <label for="check_out">Saída:</label>
    <input type="datetime-local" name="check_out" id="check_out" required>

    <button type="submit">Registrar</button>

</div>
@endsection
