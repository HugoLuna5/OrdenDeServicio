@extends('layouts.personal')
@section('contenido')


    <div class="container mt-5">
        @include('layouts.alert')
        <div class="row row-flex">

            <div class="col-md-4">

                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">Acciones para la orden de servicio</h5>

                        @if($orden->estado != null)
                            <h6>Estado: {{$orden->estado}}</h6>
                        @endif

                        @if($orden->recibidoPor != null)
                            <h6>Orden Recibida
                                por: {{$orden->recibida->nombre.' '.$orden->recibida->apellidos}}</h6>
                        @endif


                        <hr>
                        @if($orden->atendidoPor != null)
                            <h6>{{$orden->atiende->nombre.' '.$orden->atiende->apellidos}} fuiste asignado para atender
                                esta orden de servicio.</h6>

                        @endif


                        <hr>

                        <div class="form-group mt-4 d-grid gap-2">

                            <button  id="imprimirOrder" type="button" class="btn btn-outline-primary">IMPRIMIR ORDEN DE SERVICIO</button>

                            @if($orden->estado != null)

                                @if($orden->estado == 'Pendiente')
                                    <button id="marcarTerminada" class="btn btn-outline-success">MARCAR COMO TERMINADA</button>
                                @endif


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

            window.open('{{route('mostrarPdfOrdenPersonal', $orden->id)}}', '_blank').focus();


        });

        if (document.getElementById('marcarTerminada')){

            document.getElementById('marcarTerminada').addEventListener('click', function (evt) {
                evt.preventDefault()

                const options = {
                    method: 'POST',
                    body: JSON.stringify({
                        'orden_id': '{{$orden->id}}',
                    }),
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': tokenWb
                    }
                };


                fetch('{{route('actualizarOrdenPersonal')}}', options)
                    .then((res) => res.json())
                    .then((res) => {


                        if (res.status === 'success') {
                            console.log(res.message)
                            location.reload()
                        } else {
                            alert(res.message)
                        }


                    });

            });

        }



    </script>
@endsection
