<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva Cancelada</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #e9ecef;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border: 1px solid #dee2e6;
            position: relative;
        }
        .header {
            background-color: #DC3545;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-radius: 10px 10px 0 0;
        }
        .image-container {
            text-align: center;
            padding: 10px 0;
        }
        .image-container img {
            max-width: 75%;
            height: auto;
            border-radius: 10px 10px 0 0;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content p {
            font-size: 16px;
            color: #333;
        }
        .footer {
            font-size: 12px;
            color: #6c757d;
            text-align: center;
            padding-top: 10px;
            margin-top: 20px;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Espaço para imagem -->
    <div class="image-container">
        <img src="{{asset('img/logo-alerj-grande_azul.png')}}" alt="Reserva Cancelada">
    </div>

    <div class="header">
        AGENDAMENTO CANCELADO
    </div>

    <div class="content">
        <h1>Olá, {{$reservation->person['full_name']}}</h1>
        <p style="font-size: 20px">Infelizmente, seu agendamento para o dia {{ date_format($reservation->reservation_date,"d/m/Y") }} foi cancelado.</p>
        <p style="font-size: 20px">Para mais informações, por favor, entre em contato com o setor responsável: <strong>{{$reservation->sector?->nickname}}</strong>.</p>
    </div>

    <div class="footer">
        <p>&copy; 2024 ALERJ - ASSEMBLEIA LEGISLATIVA DO ESTADO DO RIO DE JANEIRO</p>
    </div>
</div>
</body>
</html>
