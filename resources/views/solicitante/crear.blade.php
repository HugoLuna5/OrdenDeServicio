@extends('layouts.solicitante')
@section('contenido')

    <div class="container mt-5">

        @include('layouts.alert')

        <div class="row">

            <div class="col-6 offset-3">

                <div class="card">

                    <div class="card-body">

                        <form action="{{route('guardarOrdenSolicitante')}}" method="POST">
                            @csrf

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
                                <textarea class="form-control" required name="descripcion" id="descripcion" ></textarea>
                            </div>
                            <div class="form-group mt-4 d-grid gap-2">

                                <button type="submit" class="btn btn-outline-success btn-block">CREAR ORDEN DE SERVICIO</button>

                            </div>



                        </form>


                    </div>

                </div>

            </div>

        </div>

    </div>



@endsection
