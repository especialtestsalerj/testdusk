<!DOCTYPE html>
<html>
<head>
    <title>Reserva Cancelada</title>
</head>
<body>
<h1>Olá {{json_decode($reservation->person)->full_name}}</h1>
<p>Infelizmente sua reserva para o dia  {{ date_format($reservation->reservation_date,"d/m/Y") }} foi cancelada para maiores informações, entre em contato com o setor:
    {{$reservation->sector?->nickname}}</p>
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
