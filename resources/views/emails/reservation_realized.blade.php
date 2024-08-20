<!DOCTYPE html>
<html>
<head>
    <title>Reserva Cancelada</title>
</head>
<body>
<h1>Olá {{$reservation->person['full_name']}}</h1>
<p>Obrigado pela visita e esperamos reve-los em uma próxima visita.</p>
<p>
   <a href="https://docs.google.com/forms/d/e/1FAIpQLSdT0wxJ0J8NpTg900C301Reob5WMm9019GLgJtUj9g22HGNVg/viewform">Formulário de Satisfação</a>
</p>
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
