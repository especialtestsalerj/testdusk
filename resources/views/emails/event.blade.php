<!DOCTYPE html>
<html>
<head>
    <title>Nova Ocorrência</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            margin: 0 0 10px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Nova Ocorrência</h1>
    <p>Data da Ocorrência: {{$event->occurred_at->format('d/m/Y \à\s H:i')}}</p>
    <p><strong>Tipo:</strong> {{$event->eventType?->name}}</p>
    <p><strong>Setor:</strong> {{$event->sector?->name}}</p>
    <p><strong>Plantonista:</strong> {{$event->dutyUser?->name}}</p>
    <p><strong>Observações:</strong> {{$event->description}}</p>

    <a href="{{route('routines.index')}}/{{$event->routine_id}}/events/{{$event->id}}/show?redirect=routines.show&disabled=1">
        Visualizar Detalhes da Ocorrência
    </a>
</div>

</body>
</html>
