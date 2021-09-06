<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NuevoUsuario;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsuariosController extends Controller
{


    public function inicio()
    {

        $id = Auth::user()->id;
        $usuarios = User::where('id', '!=', $id)
            ->paginate(15);


        return view('admin.usuarios.inicio', compact('usuarios'));

    }

    public function mostrar($id)
    {
        $usuario = User::find($id);

        if ($usuario != null) {
            $departamentos = Departamento::all();
            return view('admin.usuarios.mostrar', compact('usuario', 'departamentos'));
        }


        return back();

    }

    public function crear()
    {

        return view('admin.usuarios.crear');
    }

    public function guardar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipoUsuario' => ['required'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'telefono' => ['required', 'string', 'max:255', 'unique:users'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $pass = Str::random(8);

        $request['password'] = Hash::make($pass);

        $user = User::create($request->all());

        if ($user != null) {
            $notification = array(
                'message' => 'Usuario agregado correctamente ',
                'alert-type' => 'success'
            );


            $objDemo = new \stdClass();
            $objDemo->nombre = $request->nombre . ' ' . $request->apellidos;
            $objDemo->contra = $pass;
            $objDemo->sender = 'ordenservicioitsta@gmail.com';
            $objDemo->correo = $request->email;

            Mail::to($request->email)->send(new NuevoUsuario($objDemo));


            return back()->with($notification);

        }
        $notification = array(
            'message' => 'Ocurrio un error al crear el usuario, intentalo de nuevo más tarde',
            'alert-type' => 'error'
        );
        return back()->with($notification);


    }


    public function actualizar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'tipoUsuario' => ['required'],
            'nombre' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $user = User::find($request->id);


        if ($user->update($request->all())) {
            $notification = array(
                'message' => 'Usuario actualizado correctamente',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }

        $notification = array(
            'message' => 'Ocurrio un error al actualizar el usuario, intentalo de nuevo más tarde',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }


    public function eliminar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required'],

        ]);

        if ($validator->fails()) {

            return response()->json(['status' => 'error', 'message' => 'Todos los campos son requeridos: ' . $validator->errors()], 200);

        }

        $us = User::find($request->id);

        if ($us->delete()) {

            return response()->json(['status' => 'success', 'message' => 'Usuario eliminado correctamente'], 200);

        }

        return response()->json(['status' => 'error', 'message' => 'Ocurrio un error al eliminar al usuario, intentalo más tarde'], 200);


    }

}
