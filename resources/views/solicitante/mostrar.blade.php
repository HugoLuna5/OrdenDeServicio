@extends('layouts.solicitante')
@section('contenido')

    <div class="container mt-5">

        @include('layouts.alert')

        <div class="row">

            <div class="col-6 offset-3">

                <div class="card">

                    <div class="card-body">

                        <form action="{{route('actualizarOrdenSolicitante')}}" method="POST">
                            @csrf

                            <input type="hidden" name="id" id="id" value="{{$orden->id}}">
                            <div class="from-group">
                                <label for="prioridad">Tipo de Servicio</label>
                                <select name="prioridad" id="prioridad" class="form-control">
                                    <option value="" disabled>Selecciona una opción</option>
                                    <option value="Ordinario">Ordinario</option>
                                    <option value="Urgente">Urgente</option>
                                    <option value="Extraordinario">Extraordinario</option>

                                </select>

                            </div>
                            <div class="from-group mt-1">
                                <label for="departamentoId">Departamento</label>
                                <select name="departamentoId" id="departamentoId" class="form-control">
                                    <option value="" disabled>Selecciona un area</option>
                                    @foreach($departamentos as $departamento)
                                        <option value="{{$departamento->id}}">{{$departamento->nombre}}</option>
                                    @endforeach


                                </select>
                            </div>
                            <div class="from-group mt-1">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" required name="descripcion" id="descripcion">{{$orden->descripcion}}</textarea>
                            </div>
                            <div class="form-group mt-4 d-grid gap-2">

                                <button type="submit" class="btn btn-outline-success btn-block">ACTUALIZAR ORDEN DE
                                    SERVICIO
                                </button>

                                <button id="eliminarOrden" type="button" class="btn btn-outline-danger btn-block">ELIMINAR ORDEN DE
                                    SERVICIO
                                </button>

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
        document.getElementById('prioridad').value = '{{$orden->prioridad}}';
        document.getElementById('departamentoId').value = '{{$orden->departamentoId}}';
        const headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json'
        };

        document.getElementById('eliminarOrden').addEventListener('click', function (evt) {
            evt.preventDefault();


            fetch('{{route('eliminarOrdenSolicitante')}}', {
                method: 'POST',
                body: JSON.stringify({
                    id: document.getElementById('id').value
                }),
                headers: headers
            }).then((response) => response.json())
                .then(function (data) {
                    console.log(data)
                    if (data.status === 'success') {
                        location.href = '/solicitante'
                    } else {
                        location.reload();
                    }
                });

        });


    </script>
@endsection
