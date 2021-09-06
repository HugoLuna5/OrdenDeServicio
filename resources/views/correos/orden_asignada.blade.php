<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nueva orden de servicio</title>
</head>
<body>


<h2>Hola, {{ $mail->nombre }}</h2>
<p>Se te ha asignado una nueva orden de servicio del departamento {{$mail->departamento}}, solicitada por {{$mail->solicitante}}.</p>
<p>Atiendela lo antes posible.</p>


<p><a href="{{route('personalMostrarOrden', $mail->id)}}" class="btn btn-primary">Ver orden de servicio</a></p>
<br>


</body>
</html>
