@extends('layouts.personal')

@section('contenido')


    <div class="container mt-5">
        @include('layouts.alert')
        <div class="row">

            <div class="col-md-6 offset-3">

                <div class="card">


                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Solicitante</th>
                                <th>Area</th>
                                <th>Tipo de servicio</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ordenes as $orden)

                                <tr onclick="location.href = '{{route('personalMostrarOrden', $orden->id)}}'">
                                    <th>{{$orden->id}}</th>
                                    <th>{{$orden->solicitante->nombre.' '.$orden->solicitante->apellidos}}</th>
                                    <th>{{$orden->departamento->nombre}}</th>
                                    <th>{{$orden->prioridad}}</th>
                                    <th>{{$orden->created_at}}</th>
                                </tr>

                            @endforeach
                            </tbody>

                        </table>

                    </div>


                </div>


            </div>

        </div>

    </div>

@endsection
