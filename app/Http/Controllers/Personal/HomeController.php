<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Mail\CorreoOrdenNueva;
use App\Mail\OrdenAtendida;
use App\Models\OrdenServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public $responseStatusOk = 200;

    public function inicio(){

        $id = Auth::user()->id;

        $ordenes = OrdenServicio::where('atendidoPor', '=', $id)
        ->paginate('15');

        return view('personal.incio', compact('ordenes'));


    }



    public function mostrar($id){

        $orden = OrdenServicio::find($id);


        if ($orden != null){

            return view('personal.mostrar', compact('orden'));

        }

        abort(404);


    }


    public function actualizar(Request $request){
        $validator = Validator::make($request->all(), [
            'orden_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Todos los campos son requeridos, intentalo de nuevo más tarde '], $this->responseStatusOk);
        }

        $orden = OrdenServicio::find($request->orden_id);


        if ($orden != null){

            $orden->estado = 'Atendida';

            if ($orden->update()){



                $objDemo = new \stdClass();
                $objDemo->nombre = $orden->recibida->nombre.' '.$orden->recibida->apellidos;
                $objDemo->solicitante = $orden->solicitante->nombre.' '.$orden->solicitante->apellidos;
                $objDemo->departamento = $orden->departamento->nombre;
                $objDemo->id = $orden->id;
                $objDemo->dirigida = 'dep';
                $objDemo->sender = 'ordenservicioitsta@gmail.com';

                Mail::to($orden->recibida->email)->send(new OrdenAtendida($objDemo));



                $objDemo2 = new \stdClass();
                $objDemo2->nombre = $orden->solicitante->nombre.' '.$orden->solicitante->apellidos;
                $objDemo2->departamento = $orden->departamento->nombre;
                $objDemo2->id = $orden->id;
                $objDemo2->dirigida = 'sol';
                $objDemo2->sender = 'ordenservicioitsta@gmail.com';

                Mail::to($orden->solicitante->email)->send(new OrdenAtendida($objDemo));



                return response()->json(['status' => 'success', 'message' => 'La orden fue actualizada correctamente'], $this->responseStatusOk);

            }


        }



        return response()->json(['status' => 'error', 'message' => 'Tu orden de servicio no fue encontrada'], $this->responseStatusOk);


    }


    public function pdf($id){

        $orden = OrdenServicio::find($id);


        if ($orden != null){

            return view('pdf.orden', compact('orden'));

        }

        abort(404);

    }


}
