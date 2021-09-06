<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartamentoController extends Controller
{

    public function inicio()
    {

        $departamentos = Departamento::paginate(15);
        return view('admin.departamentos.inicio', compact('departamentos'));
    }

    public function mostrar($id){

        $departamento = Departamento::find($id);

        if ($departamento != null){
            return view('admin.departamentos.mostrar', compact('departamento'));
        }

        return back();


    }


    public function crear()
    {
        return view('admin.departamentos.crear');
    }


    public function guardar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'unique:departamentos'],

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $dep = Departamento::create($request->all());
        if ($dep != null){
            $notification = array(
                'message' => 'Departamento agregado correctamente',
                'alert-type' => 'success'
            );
            return back()->with($notification);

        }
        $notification = array(
            'message' => 'Ocurrio un error al crear el departamento, intentalo de nuevo más tarde',
            'alert-type' => 'error'
        );
        return back()->with($notification);


    }

    public function actualizar(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => ['required'],
            'nombre' => ['required'],

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los campos son requeridos: ' . $validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        $dep = Departamento::find($request->id);


        if ($dep->update($request->all())){
            $notification = array(
                'message' => 'Departamento actualizado correctamente',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }
        $notification = array(
            'message' => 'Ocurrio un error al actualizar el departamento, intentalo de nuevo más tarde',
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


        $dep = Departamento::find($request->id);


        if ($dep->delete()){
            return response()->json(['status' => 'success', 'message' =>'Departamento eliminado correctamente' ], 200);

        }

        return response()->json(['status' => 'error', 'message' =>'Ocurrio un error al eliminar el departamento, intentalo más tarde' ], 200);



    }



}
