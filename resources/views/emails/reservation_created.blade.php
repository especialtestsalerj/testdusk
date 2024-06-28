<!DOCTYPE html>
<html>
<head>
    <title>Reserva Criada</title>
</head>
<body>
<h1>Olá {{json_decode($reservation->person)->full_name}}</h1>
<p>Sua reserva foi criada com os seguintes detalhes:</p>
<ul>
    <li>ID da Reserva: {{ $reservation->code }}</li>
    <li>Data: {{ date_format($reservation->reservation_date,"d/m/Y") }}</li>
    <li>Setor: {{$reservation->sector?->nickname}}</li>
</ul>
<p>Obrigado por usar nosso serviço!</p>
</body>
</html>
