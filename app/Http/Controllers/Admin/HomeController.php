<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrdenServicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function inicio(){


        $ordenes = OrdenServicio::
            orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.inicio', compact('ordenes'));



    }

}
