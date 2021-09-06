<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />

    <title>Orden de Servicio</title>
    <style>

        @media print {
            body {-webkit-print-color-adjust: exact;}

            .headerTitle {
                background: rgba(0, 0, 0, 0.71) !important;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        }

        .headerTitle {
            background: rgba(0, 0, 0, 0.71) !important;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .headerTitle h4 {
            color: #fff;
        }

        .logo {
            width: 120px;
            height: 120px;
        }

        .centerTxt {
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .bordeFirma {
            border-bottom: 1px solid black;
            margin: 8px;
        }

        .bordeContenido {
            box-sizing: border-box;
            border: 1px;
            border-style: solid;
            border-color: #000;
            padding: 10px;
        }
    </style>
</head>
<body>
<div class="headerTitle">
    <h4>INSTITUTO TECNOLÓGICO SUPERIOR DE TANTOYUCA</h4>
</div>

<div class="container">
    <div class="row">
        <div class="col-3 centerTxt">
            <img class="logo" src="{{url('/img/logo_itsta.png')}}" alt=""/>
        </div>
        <div class="col-4"></div>
        <div class="col-5 text-center centerTxt">
            <h4>ORDEN DE SERVICIO</h4>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-6 offset-3 centerTxt">
        <p>TIPO DE SERVICIO</p>
    </div>
</div>

<div class="container">
    <div class="col-6 offset-3 centerTxt">


        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="inlineRadioOptions"
                id="inlineRadio1"
                value="option1"
                @php
                    echo $orden->prioridad == 'Ordinario' ? 'checked' : 'disabled';
                @endphp

            />

            <label class="form-check-label" for="inlineRadio1"
            >ORDINARIO</label
            >
        </div>
        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="inlineRadioOptions"
                id="inlineRadio2"
                value="option2"
                @php
                    echo $orden->prioridad == 'Urgente' ? 'checked' : 'disabled';

                @endphp
            />
            <label class="form-check-label" for="inlineRadio2"
            >URGENTE</label
            >
        </div>
        <div class="form-check form-check-inline">
            <input
                class="form-check-input"
                type="radio"
                name="inlineRadioOptions"
                id="inlineRadio3"
                value="option3"
                @php
                    echo $orden->prioridad == 'Extraordinario' ? 'checked' : 'disabled';
                @endphp

            />
            <label class="form-check-label" for="inlineRadio3"
            >EXTRAORDINARIO</label>
        </div>

    </div>
</div>

<div class="container mt-3 ml-4">
    <div class="row">
        <div class="col-10 offset-1">
            <p>SOLICITANTE: <u>{{$orden->solicitante->nombre.' '.$orden->solicitante->apellidos}}</u></p>
            <p>AREA: <u>{{$orden->departamento->nombre}}</u></p>
            <p>DESCRIPCIÓN DE LO SOLICITADO:</p>
            <div class="bordeContenido col-12">
                <p>
                    {{$orden->descripcion}}
                </p>
            </div>
        </div>
    </div>
</div>

<div class="headerTitle mt-5">
    <div class="container">
        <div class="row text-white">
            <div class="col-1"></div>
            <div class="col-3 centerTxt">SOLICITA</div>
            <div class="col-3 centerTxt">RECIBE</div>
            <div class="col-3 centerTxt">EJECUTA</div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-1 centerTxt">
            <p class="">
                Nombre <br/>
                y Firma
            </p>
        </div>
        <div class="col-3 centerTxt mt-3 bordeFirma">
            {{$orden->solicitante->nombre.' '.$orden->solicitante->apellidos}}
        </div>
        <div class="col-3 centerTxt mt-3 bordeFirma">
            {{$orden->recibida->nombre.' '.$orden->recibida->apelllidos}}
        </div>
        <div class="col-3 centerTxt mt-3 bordeFirma">
            {{$orden->atiende->nombre.' '.$orden->atiende->apellidos}}
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-6">Fecha y Hora: {{$orden->created_at}}</div>
    </div>
</div>

<script>

    window.print();

</script>

</body>
</html>
