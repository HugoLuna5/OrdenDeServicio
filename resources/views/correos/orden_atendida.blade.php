
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Orden de servicio actualizada</title>
</head>
<body>


<h2>Hola, {{ $mail->nombre }}</h2>


@if($mail->dirigida == 'dep')
    <p>Se ha actualizado la orden de servicio del departamento {{$mail->departamento}}, solicitada por {{$mail->solicitante}}.</p>
    <p><a href="{{route('mostrarOrdenDepartamento', $mail->id)}}" class="btn btn-primary">Ver orden de servicio</a></p>
@else
    <p>Se ha actualizado la orden de servicio del departamento {{$mail->departamento}}, que solicitaste.</p>
    <p><a href="{{route('mostrarOrdenSolicitante', $mail->id)}}" class="btn btn-primary">Ver orden de servicio</a></p>
@endif

<br>


</body>
</html>
