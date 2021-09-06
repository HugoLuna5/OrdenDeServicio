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
                                <button onclick="location.href = '{{route('crearDepartamentoAdmin')}}'" class="btn btn-success">Agregar departamento</button>
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
                                    <th>Num. solicitudes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($departamentos as $departamento)
                                    <tr onclick="location.href = '{{route('mostrarDepartamentoAdmin', $departamento->id)}}'">
                                        <td>{{$departamento->id}}</td>
                                        <td>{{$departamento->nombre}}</td>
                                        <td>{{$departamento->ordenes->count()}}</td>
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
