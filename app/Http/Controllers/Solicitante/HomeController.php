<?php

namespace App\Http\Controllers\Solicitante;

use App\Http\Controllers\Controller;
use App\Mail\CorreoOrdenNueva;
use App\Mail\NuevoUsuario;
use App\Models\Departamento;
use App\Models\OrdenServicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Exception\Messaging\InvalidMessage;
use Kreait\Firebase\Messaging\CloudMessage;

class HomeController extends Controller
{

    public function inicio(){

        $id = Auth::user()->id;

        $ordenes = OrdenServicio::where('solicitanteId', '=', $id)
        ->orderBy('created_at', 'ASC')->get();
        return view('solicitante.inicio', compact('ordenes'));
    }


    public function mostrar($id){

        $orden = OrdenServicio::find($id);


        if ($orden != null){
            $departamentos = Departamento::all();

            return view('solicitante.mostrar', compact('departamentos', 'orden'));
        }

        return back();


    }


    public function crear(){

        $departamentos = Departamento::all();

        return view('solicitante.crear', compact('departamentos'));
    }

    public function guardar(Request $request){
        $validator = Validator::make($request->all(), [
            'prioridad' => ['required'],
            'departamentoId' => ['required'],
            'descripcion' => ['required'],

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $us = Auth::user();

        $request['solicitanteId'] = $us->id;
        $request['estado'] = "Pendiente";


        $orden = OrdenServicio::create($request->all());


        if ($orden != null){


            $usuarios = User::where('tipoUsuario', '!=', 2)
            ->whereNotNull('token')
            ->get();
            $messaging = app('firebase.messaging');

            $emails = array();

            foreach ($usuarios as $usuario){

                $message = CloudMessage::fromArray([
                    'token' => $usuario->token,
                    'notification' => [
                        'title' => 'Nueva orden de servicio',
                        'body' => "Haz recibido una nueva orden de servicio"
                    ],
                    'data' => [
                        'action' => 'departamentoNuevaOrden',
                        'orden_id' => $orden->id,
                    ],
                ]);

                $messaging->send($message);

                array_push($emails, $usuario->email);

            }

            $dep = Departamento::find($request->departamentoId);

            $objDemo = new \stdClass();
            $objDemo->solicitante = $us->nombre.' '.$us->apellidos;
            $objDemo->departamento = $dep->nombre;
            $objDemo->id = $orden->id;
            $objDemo->sender = 'ordenservicioitsta@gmail.com';

            Mail::to($emails)->send(new CorreoOrdenNueva($objDemo));



            $notification = array(
                'message' => 'Orden creada correctamente',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        $notification = array(
            'message' => 'Ocurrio un error al crear la orden de servicio, intentalo de nuevo más tarde',
            'alert-type' => 'error'
        );
        return back()->with($notification);



    }


    public function actualizar(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'prioridad' => ['required'],
            'departamentoId' => ['required'],
            'descripcion' => ['required'],

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $orden = OrdenServicio::find($request->id);

        if ($orden->update($request->all())){

            $notification = array(
                'message' => 'Orden actualizada correctamente',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        $notification = array(
            'message' => 'Ocurrio un error al actualizar la orden, intentalo de nuevo más tarde',
            'alert-type' => 'error'
        );
        return back()->with($notification);


    }



    public function eliminar(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => ['required'],

        ]);

        if ($validator->fails()) {

            return response()->json(['status' => 'error', 'message' =>'Todos los campos son requeridos: ' . $validator->errors() ], 200);

        }

        $orden = OrdenServicio::find($request->id);

        if ($orden->delete()){
            return response()->json(['status' => 'success', 'message' =>'Orden eliminada correctamente' ], 200);

        }

        return response()->json(['status' => 'error', 'message' =>'Ocurrio un error al eliminar la orden, intentalo más tarde' ], 200);



    }

}
