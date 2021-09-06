<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/redirigir', function () {
    $role = Auth::user()->tipoUsuario;

    // Check user role
    switch ($role) {
        case 1:
            return redirect('/admin');
        case 2:
            return redirect('/solicitante');
        case 3:
            return redirect('/personal');
        default:
            return 0;

    }
})->middleware('auth');

Route::get('/', function () {
    return \Illuminate\Support\Facades\Redirect::route('login');
});

//Se necesita iniciar sesion para poder acceder a la aplicacion web
Route::middleware(['auth'])->group(function () {


    Route::post('/guardar/token', 'App\Http\Controllers\TokenController@guardar');

    /**
     * Rutas para el usuario administrador
     */
    Route::group(['middleware' => ['rol:1']], function () {

        Route::prefix('/admin')->group(function () {

            Route::get('', 'App\Http\Controllers\Admin\HomeController@inicio')->name('inicoAdmin');

            Route::prefix('/ordenes')->group(function (){
                Route::get('/{id}', 'App\Http\Controllers\Admin\OrdenController@mostrar')->name('mostrarOrdenDepartamento');
                Route::get('/{id}/pdf', 'App\Http\Controllers\Admin\OrdenController@pdf')->name('mostrarPdfOrdenDepartamento');

                Route::post('/recibida', 'App\Http\Controllers\Admin\OrdenController@recibida')->name('recibidaDepartamento');
                Route::post('/asignar', 'App\Http\Controllers\Admin\OrdenController@asignar')->name('asignarOrdenDepartamento');

            });

            Route::prefix('/usuarios')->group(function () {
                Route::get('/', 'App\Http\Controllers\Admin\UsuariosController@inicio')->name('mostrarUsuariosAdmin');
                Route::get('/crear', 'App\Http\Controllers\Admin\UsuariosController@crear')->name('crearUsuarioAdmin');
                Route::get('/mostrar/{id}', 'App\Http\Controllers\Admin\UsuariosController@mostrar')->name('mostrarUsuarioAdmin');


                Route::post('/guardar', 'App\Http\Controllers\Admin\UsuariosController@guardar')->name('guardarUsuarioAdmin');
                Route::post('/actualizar', 'App\Http\Controllers\Admin\UsuariosController@actualizar')->name('actualizarUsuarioAdmin');
                Route::post('/eliminar', 'App\Http\Controllers\Admin\UsuariosController@eliminar')->name('eliminarUsuarioAdmin');

            });

            Route::prefix('/departamentos')->group(function () {

                Route::get('', 'App\Http\Controllers\Admin\DepartamentoController@inicio')->name('inicioDepartamentoAdmin');
                Route::get('/crear', 'App\Http\Controllers\Admin\DepartamentoController@crear')->name('crearDepartamentoAdmin');

                Route::post('/guardar', 'App\Http\Controllers\Admin\DepartamentoController@guardar')->name('guardarDepartamentoAdmin');
                Route::get('/mostrar/{id}', 'App\Http\Controllers\Admin\DepartamentoController@mostrar')->name('mostrarDepartamentoAdmin');
                Route::post('/actualizar', 'App\Http\Controllers\Admin\DepartamentoController@actualizar')->name('actualizarDepartamentoAdmin');
                Route::post('/eliminar', 'App\Http\Controllers\Admin\DepartamentoController@eliminar')->name('eliminarDepartamentoAdmin');


            });


        });

    });

    /**
     * Rutas para el usuario solicitante
     */
    Route::group(['middleware' => ['rol:2']], function () {

        Route::prefix('/solicitante')->group(function () {

            Route::get('', 'App\Http\Controllers\Solicitante\HomeController@inicio')->name('solicitanteInicio');
            Route::get('/crear/orden', 'App\Http\Controllers\Solicitante\HomeController@crear')->name('crearOrdenSolicitante');
            Route::get('/mostrar/orden/{id}', 'App\Http\Controllers\Solicitante\HomeController@mostrar')->name('mostrarOrdenSolicitante');

            Route::post('/guardar/orden', 'App\Http\Controllers\Solicitante\HomeController@guardar')->name('guardarOrdenSolicitante');
            Route::post('/actualizar/orden', 'App\Http\Controllers\Solicitante\HomeController@actualizar')->name('actualizarOrdenSolicitante');
            Route::post('/eliminar/orden', 'App\Http\Controllers\Solicitante\HomeController@eliminar')->name('eliminarOrdenSolicitante');

        });

    });

    /**
     * Rutas para el usuario "personal" - El que atiende la ordenes
     */
    Route::group(['middleware' => ['rol:3']], function () {

        Route::prefix('/personal')->group(function () {
            Route::get('', 'App\Http\Controllers\Personal\HomeController@inicio')->name('personalIncio');
            Route::get('/ordenes/{id}', 'App\Http\Controllers\Personal\HomeController@mostrar')->name('personalMostrarOrden');
            Route::get('/ordenes/{id}/pdf', 'App\Http\Controllers\Personal\HomeController@pdf')->name('mostrarPdfOrdenPersonal');

            Route::post('/ordenes/actualizar/estado', 'App\Http\Controllers\Personal\HomeController@actualizar')->name('actualizarOrdenPersonal');

        });
    });

});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
