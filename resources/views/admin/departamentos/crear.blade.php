@extends('layouts.admin')

@section('contenido')

<div class="container mt-5">

    @include('layouts.alert')
    <div class="row">

        <div class="col-md-6 offset-3">

            <div class="card">

                <div class="card-body">


                    <form action="{{route('guardarDepartamentoAdmin')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre del departamento</label>
                            <input  class="form-control mt-1" type="text" name="nombre" id="nombre" placeholder="Escribe el nombre del departamento" required autofocus>


                        </div>


                        <div class="form-group mt-4 d-grid gap-2">

                            <button type="submit" class="btn btn-outline-success btn-block">Agregar departamento</button>

                        </div>


                    </form>


                </div>


            </div>

        </div>

    </div>

</div>



@endsection
