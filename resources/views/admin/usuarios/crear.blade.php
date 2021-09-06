@extends('layouts.admin')

@section('contenido')


    <div class="container mt-5">

        @include('layouts.alert')
        <div class="row">

            <div class="col-md-6 offset-3">

                <div class="card">


                    <div class="card-body">


                        <form action="{{route('guardarUsuarioAdmin')}}" method="POST">
                            @csrf

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
                                <input class="form-control" required type="text" name="nombre" id="nombre">
                            </div>

                            <div class="form-group mt-1">
                                <label for="apellidos">Apellidos</label>
                                <input class="form-control" required type="text" name="apellidos" id="apellidos">
                            </div>
                            <div class="form-group mt-1">
                                <label for="email">Correo</label>
                                <input class="form-control" required type="email" name="email" id="email">
                            </div>


                            <div class="form-group mt-1">
                                <label for="telefono">Telefono</label>
                                <input class="form-control" required type="text" name="telefono" id="telefono">
                            </div>


                            <div class="form-group mt-4 d-grid gap-2">

                                <button type="submit" class="btn btn-outline-success btn-block">Agregar usuario</button>

                            </div>


                        </form>


                    </div>


                </div>

            </div>


        </div>

    </div>



@endsection
