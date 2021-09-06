@extends('layouts.admin')

@section('contenido')


    <div class="container mt-5">
        @include('layouts.alert')
        <div class="row">


            <div class="col-12">


                <div class="card">


                    <div class="card-body">


                        <div class="table-responsive">


                            <table class="table table-striped table-hover">

                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Solicitante</th>
                                    <th>Tipo de servicio</th>
                                    <th>Fecha</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($ordenes as $orden)

                                    <tr onclick="location.href = '{{route('mostrarOrdenDepartamento', $orden->id)}}'">
                                        <td>{{$orden->id}}</td>
                                        <td>{{$orden->solicitante->nombre.' '.$orden->solicitante->apellidos}}</td>
                                        <td>{{$orden->prioridad}}</td>
                                        <td>{{$orden->created_at}}</td>
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
