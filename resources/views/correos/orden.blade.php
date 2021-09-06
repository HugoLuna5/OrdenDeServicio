<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nueva orden de servicio</title>
</head>
<body>


<h2>Hola, {{ $mail->departamento }}</h2>
<p>Haz recibido una nueva orden de servicio de {{$mail->solicitante}}.</p>
<p>Atiendela lo antes posible.</p>


<p><a href="{{route('mostrarOrdenDepartamento', $mail->id)}}" class="btn btn-primary">Ver orden de servicio</a></p>
<br>


</body>
</html>
