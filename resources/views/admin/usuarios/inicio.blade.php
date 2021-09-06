@extends('layouts.admin')

@section('contenido')


    <div class="container mt-4">
        @include('layouts.alert')
        <div class="row">


            <div class="col-md-8 offset-2">


                <div class="card">

                    <div class="card-header">

                        <div class="row">
                            <div class="col"></div>
                            <div class="col-auto">
                                <button onclick="location.href = '{{route('crearUsuarioAdmin')}}' " class="btn btn-success">Agregar usuario</button>
                            </div>
                        </div>

                    </div>


                    <div class="card-body">


                        <div class="table-responsive">


                            <table class="table table-striped table-hover">

                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Rol</th>
                                        <th>Correo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($usuarios as $usuario)
                                    <tr onclick="location.href = '{{route('mostrarUsuarioAdmin', $usuario->id)}}'">
                                        <td>{{$usuario->id}}</td>
                                        <td>{{$usuario->nombre}}</td>
                                        <td>{{$usuario->apellidos}}</td>
                                        <td>{{$usuario->rol->nombre}}</td>
                                        <td>{{$usuario->email}}</td>
                                    </tr>
                                @endforeach


                                </tbody>


                            </table>

                        </div>


                    </div>
                </div>


            </div>


        </div>


    </div>




@endsection

