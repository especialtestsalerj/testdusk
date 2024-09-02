<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Agendamento</title>
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
            background-color: #142B53;
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
            text-align: left;
        }
        .content ul {
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            background-color: #DBDFEB;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .content ul li strong {
            color: #142B53;
        }
        .notice {
            background-color: #F0F4F8;
            color: #333;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
            border-left: 4px solid #142B53;
            font-size: 16px;
        }
        .cancel-text {
            font-size: 14px;
            color: #333;
            margin-top: 20px;
            text-align: center;
        }
        .button {
            display: block;
            width: 100%;
            text-align: center;
            padding: 15px 0;
            background-color: #DC3545;
            color: #ffffff;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #C82333;
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

    <div class="image-container">
        <img src="{{asset('img/logo-alerj-grande_azul.png')}}" alt="Imagem de Reserva">
    </div>

    <div class="header">
        CADASTRO DE AGENDAMENTO
    </div>

    <div class="content">
        <h1>Olá, {{$reservation->person['full_name']}}</h1>
        <p>Seu agendamento foi criado com os seguintes detalhes:</p>
        <ul>
            <li><strong>Código:</strong> {{ $reservation->code }}</li>
            <li><strong>Data/Hora:</strong> {{ date_format($reservation->reservation_date,"d/m/Y") }}</li>
            <li><strong>Destino:</strong> {{$reservation->sector?->nickname}}</li>
        </ul>
        <p class="notice">
            Atenção: Este agendamento ainda precisa ser autorizado. Você receberá uma confirmação por email assim que o agendamento for aprovado.
        </p>
    </div>

    <p class="cancel-text">
        Se você precisar cancelar este agendamento, clique no botão abaixo:
    </p>

    <a href="{{ route('reservation.cancel', ['uuid' => $reservation->uuid]) }}" class="button">
        Cancelar Agendamento
    </a>

    <div class="footer">
        <p>&copy; 2024 ALERJ - ASSEMBLEIA LEGISLATIVA DO ESTADO DO RIO DE JANEIRO</p>
    </div>
</div>
</body>
</html>
