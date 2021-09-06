@extends('layouts.admin')

@section('contenido')

    <div class="container mt-5">

        @include('layouts.alert')
        <div class="row">

            <div class="col-md-6 offset-3">

                <div class="card">

                    <div class="card-body">


                        <form action="{{route('actualizarDepartamentoAdmin')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$departamento->id}}">
                            <div class="form-group">
                                <label for="nombre">Nombre del departamento</label>
                                <input value="{{$departamento->nombre}}" class="form-control mt-1" type="text"
                                       name="nombre" id="nombre" placeholder="Escribe el nombre del departamento"
                                       required autofocus>


                            </div>


                            <div class="form-group mt-4 d-grid gap-2">

                                <button type="submit" class="btn btn-outline-success">Actualizar departamento</button>

                                <button id="deleteDep" type="button" class="btn btn-outline-danger ">Eliminar
                                    departamento
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
        const headers = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json'
        };

        document.getElementById('deleteDep').addEventListener('click', function (evt) {
            evt.preventDefault();

            fetch('{{route('eliminarDepartamentoAdmin')}}', {
                method: 'POST',
                body: JSON.stringify({
                    id: document.getElementById('id').value
                }),
                headers: headers
            }).then((response) => response.json())
                .then(function (data) {
                    console.log(data)
                    if (data.status === 'success') {
                        location.href = '/admin/departamentos'
                    } else {
                        location.reload();
                    }
                });


        });


    </script>

@endsection
