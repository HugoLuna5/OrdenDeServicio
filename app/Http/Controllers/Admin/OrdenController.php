<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrdenAsignada;
use App\Models\Departamento;
use App\Models\OrdenServicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrdenController extends Controller
{
    public function mostrar($id)
    {
        $orden = OrdenServicio::find($id);

        $usuarios = User::where('tipoUsuario', '=', 3)
            ->get();

        if ($orden != null) {
            return view('admin.ordenes.mostrar', compact('orden', 'usuarios'));

        }

         abort(404);


    }

    public function recibida(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $orden = OrdenServicio::find($request->id);


        if ($orden != null){

            $request['recibidoPor'] = Auth::user()->id;


            if ($orden->update($request->all())){

                $notification = array(
                    'message' => 'Orden actualizada correctamente',
                    'alert-type' => 'success'
                );
                return back()->with($notification);

            }


        }


        $notification = array(
            'message' => 'Ocurrio un error al marcar la orden como recibida, intentalo de nuevo más tarde',
            'alert-type' => 'error'
        );
        return back()->with($notification);


    }


    public function asignar(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'atendidoPor' => ['required'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $orden = OrdenServicio::find($request->id);


        if ($orden != null){

            if ($orden->update($request->all())){


                $personal = User::find($request->atendidoPor);
                $solicitante = User::find($orden->solicitanteId);

                $dep = Departamento::find($orden->departamentoId);

                $objDemo = new \stdClass();
                $objDemo->nombre = $personal->nombre.' '.$personal->apellidos;
                $objDemo->solicitante = $solicitante->nombre.' '.$solicitante->apellidos;
                $objDemo->departamento = $dep->nombre;
                $objDemo->id = $orden->id;
                $objDemo->sender = 'ordenservicioitsta@gmail.com';

                Mail::to($personal->email)->send(new OrdenAsignada($objDemo));


                $notification = array(
                    'message' => 'Orden asignada correctamente',
                    'alert-type' => 'success'
                );
                return back()->with($notification);

            }


        }

        $notification = array(
            'message' => 'Ocurrio un error al asignar la orden, intentalo de nuevo más tarde',
            'alert-type' => 'error'
        );
        return back()->with($notification);


    }


    public function pdf($id){

        $orden = OrdenServicio::find($id);


        if ($orden != null){

            return view('pdf.orden', compact('orden'));


        }

        abort(404);

    }

}
