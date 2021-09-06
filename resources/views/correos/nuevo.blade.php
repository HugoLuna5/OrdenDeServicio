<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Credenciales de acceso a la plataforma para ordenes de servicio</title>
</head>
<body>


    <h2>Hola, {{ $mail->nombre }}</h2>
    <p>Tu cuenta en la plataforma para Ordenes de servicio ha sido creada exitosamente.</p>

    <h2>Tus credenciales</h2>
    <p><b>Correo:</b>&nbsp;{{ $mail->correo }}</p>
    <p><b>Contraseña:</b>&nbsp;{{ $mail->contra }}</p>
    <p><a href="{{url('/')}}" class="btn btn-primary">Inicia sesion</a></p>
    <br>


</body>
</html>
