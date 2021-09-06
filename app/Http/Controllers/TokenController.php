<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{


    public function guardar(Request $request){

        $id = Auth::user()->id;


        $usuario = User::find($id);



        $usuario->token = $request->token;


        if ($usuario->update()){
            return response()->json(['status' => 'success', 'message' => 'Token actualizado'], 200);
        }



        return response()->json(['status' => 'error', 'message' => 'Error al actualizar el token'], 200);

    }

}
