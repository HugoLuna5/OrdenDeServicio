@extends('layouts.admin')

@section('contenido')


    <div class="container mt-5">

        @include('layouts.alert')
        <div class="row">

            <div class="col-md-6 offset-3">

                <div class="card">


                    <div class="card-body">


                        <form action="{{route('actualizarUsuarioAdmin')}}" method="POST">
                            @csrf

                            <input type="hidden" name="id" id="id" value="{{$usuario->id}}">
                            <div class="form-group">
                                <label for="tipoUsuario">Tipo de usuario</label>
                                <select class="form-control" name="tipoUsuario" id="tipoUsuario">
                                    <option value="" disabled>Selecciona un tipo</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Solicitante</option>
                                    <option value="3">Personal</option>


                                </select>

                            </div>


                            <div class="form-group mt-1">
                                <label for="nombre">Nombre</label>
                                <input value="{{$usuario->nombre}}" class="form-control" required type="text" name="nombre" id="nombre">
                            </div>

                            <div class="form-group mt-1">
                                <label for="apellidos">Apellidos</label>
                                <input value="{{$usuario->apellidos}}" class="form-control" required type="text" name="apellidos" id="apellidos">
                            </div>
                            <div class="form-group mt-1">
                                <label for="email">Correo</label>
                                <input value="{{$usuario->email}}" class="form-control" required type="email" name="email" id="email">
                            </div>


                            <div class="form-group mt-1">
                                <label for="telefono">Telefono</label>
                                <input value="{{$usuario->telefono}}" class="form-control" required type="text" name="telefono" id="telefono">
                            </div>


                            <div class="form-group mt-4 d-grid gap-2">
                                <button type="submit" class="btn btn-outline-success btn-block">Actualizar usuario</button>
                                <button id="eliminarUsuario" type="button" class="btn btn-outline-danger btn-block">Eliminar usuario</button>
                                <button id="restablecerContra" type="button" class="btn btn-outline-warning btn-block">Restablecer contraseña</button>

                            </div>


                        </form>


                    </div>


                </div>

            </div>


        </div>

    </div>



@endsection
@section('customJS')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.getElementById('departamentoId').value = '{{$usuario->departamentoId}}';
        document.getElementById('tipoUsuario').value = '{{$usuario->tipoUsuario}}';
        const id = document.getElementById('id').value;


        const headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json'
        };

        document.getElementById('eliminarUsuario').addEventListener('click', function (evt) {
           evt.preventDefault();

            fetch('{{route('eliminarUsuarioAdmin')}}', {
                method: 'POST',
                body: JSON.stringify({
                    id: id
                }),
                headers: headers
            }).then((response) => response.json())
                .then(function (data) {
                    console.log(data)
                    if (data.status === 'success') {
                        location.href = '/admin'
                    } else {
                        location.reload();
                    }
                });

        });

        document.getElementById('restablecerContra').addEventListener('click', function (evt) {
            evt.preventDefault();



        });



    </script>


@endsection
