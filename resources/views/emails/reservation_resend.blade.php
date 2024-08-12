<!DOCTYPE html>
<html>
<head>
    <title>Recuperação de Reservas</title>
</head>
<body>
<h1>Olá,</h1>


<p>Segue as reservas solicitadas:</p>
@foreach($reservations as $reservation)
    <ul>
        <li>Reservado por: {{$reservation->person['full_name']}}</li>
        <li>ID da Reserva: {{ $reservation->code }}</li>
        <li>Data: {{ date_format($reservation->reservation_date,"d/m/Y") }}</li>
        <li>Setor: {{$reservation->sector?->nickname}}</li>
        <li>Status: {{$reservation->reservationStatus?->name}}</li>
    </ul>
@endforeach

<p>Obrigado por usar nosso serviço!</p>
</body>
</html>

{{--@extends('beautymail::templates.sunny')--}}

{{--@section('content')--}}

{{--    @include ('beautymail::templates.sunny.heading' , [--}}
{{--        'heading' => 'Reserva Criada!',--}}
{{--        'level' => 'h1',--}}
{{--    ])--}}

{{--    @include('beautymail::templates.sunny.contentStart')--}}

{{--    <p>Sua reserva foi criada com os seguintes detalhes:</p>--}}

{{--    <ul>--}}
{{--        <li>ID da Reserva: 534543DDSQR</li>--}}
{{--        <li>Data: 01/01/2024</li>--}}
{{--        <li>Setor:  SETOR-TESTE</li>--}}
{{--    </ul>--}}

{{--    <p>Obrigado por usar nosso serviço!</p>--}}

{{--    @include('beautymail::templates.sunny.contentEnd')--}}

{{--    @include('beautymail::templates.sunny.button', [--}}
{{--        	'title' => 'Para cancelar a visita clique aqui',--}}
{{--        	'link' => 'http://google.com',--}}
{{--    ])--}}

{{--@stop--}}
