@extends('layouts.admin')
@section('contenido')


    <div class="container mt-5">

        @include('layouts.alert')

        <div class="row row-flex">

            <div class="col-md-4">

                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Acciones para la orden de servicio</h5>


                        @if($orden->recibidoPor == null)
                            <h6>Marcar como recibida</h6>
                            <form action="{{route('recibidaDepartamento')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{$orden->id}}">
                                <div class="form-group mt-4 d-grid gap-2">

                                    <button type="submit" class="btn btn-outline-success btn-block">RECIBIDA
                                    </button>

                                </div>
                            </form>
                        @else
                            <h6>Orden Recibida
                                por: {{$orden->recibida->nombre.' '.$orden->recibida->apellidos}}</h6>
                        @endif


                        <hr>
                        @if($orden->atendidoPor == null)
                            <h6>Asigna el personal que atendera la orden de servicio</h6>
                            <form action="{{route('asignarOrdenDepartamento')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{$orden->id}}">
                                <div class="from-group mt-1">
                                    <label for="atendidoPor">Personal</label>
                                    <select name="atendidoPor" id="atendidoPor" class="form-control">
                                        <option value="" disabled>Selecciona el personal</option>
                                        @foreach($usuarios as $usuario)
                                            <option
                                                value="{{$usuario->id}}">{{$usuario->nombre.' '.$usuario->apellidos}}</option>
                                        @endforeach


                                    </select>

                                </div>

                                <div class="form-group mt-4 d-grid gap-2">

                                    <button type="submit" class="btn btn-outline-success btn-block">ASIGNAR</button>

                                </div>


                            </form>
                        @else

                            <h6>{{$orden->atiende->nombre.' '.$orden->atiende->apellidos}} fue asignado para atender
                                esta orden de servicio.</h6>

                        @endif


                        <hr>

                        <div class="form-group mt-4 d-grid gap-2">
                            @if($orden->recibidoPor != null && $orden->atendidoPor != null)
                                <button id="imprimirOrder" type="button" class="btn btn-outline-primary">IMPRIMIR ORDEN DE SERVICIO</button>
                            @endif


                        </div>


                    </div>

                </div>
            </div>


            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">

                        <h4 class="card-title">Información de la orden de servicio</h4>

                        <div class="form-group mt-1">
                            <label for="solicitadoPor">Solicitante</label>
                            <input value="{{$orden->solicitante->nombre.' '.$orden->solicitante->apellidos}}"
                                   disabled
                                   class="form-control" type="text" name="solicitadoPor" id="solicitadoPor">
                        </div>

                        <div class="from-group mt-1">
                            <label for="prioridad">Tipo de Servicio</label>
                            <select disabled name="prioridad" id="prioridad" class="form-control">
                                <option value="">{{$orden->prioridad}}</option>


                            </select>

                        </div>
                        <div class="from-group mt-1">
                            <label for="departamentoId">Departamento</label>
                            <select disabled name="departamentoId" id="departamentoId" class="form-control">
                                <option value="">{{$orden->departamento->nombre}}</option>


                            </select>
                        </div>
                        <div class="from-group mt-1">
                            <label for="descripcion">Descripción</label>
                            <textarea disabled class="form-control" required name="descripcion"
                                      id="descripcion">{{$orden->descripcion}}</textarea>
                        </div>

                        <div class="form-group mt-1">
                            <label for="datetime">Fecha de solicitud</label>
                            <input value="{{$orden->created_at}}" disabled class="form-control" type="text"
                                   name="solicitadoPor" id="solicitadoPor">
                        </div>


                        <div class="form-group mt-4 d-grid gap-2">

                        </div>


                    </div>

                </div>

            </div>


        </div>

    </div>


@endsection

@section('customJS')
    <script>

        document.getElementById('imprimirOrder').addEventListener('click', function (evt) {
            evt.preventDefault();

            window.open('{{route('mostrarPdfOrdenDepartamento', $orden->id)}}', '_blank').focus();


        });

    </script>
@endsection
