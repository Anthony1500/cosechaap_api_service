<?php

use App\Http\Controllers\datosplantacontroller;
use App\Http\Controllers\fumigacioncontroller;
use App\Http\Controllers\usuariocontroller;
use Illuminate\Http\Request;
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
Route::get('select', function (Request $request) {
    $token = $request->session()->token();

    $token = csrf_token();
    return $token;
});
Route::post('login', [UsuarioController::class, 'login'])->middleware('firstValidation');

Route::get('img', function () {
    return response()->file(public_path('imagenes/cosecha.png'));
});

Route::get('txt', function () {
    return response()->file(public_path('versions/version.txt'));
});
Route::get('apk', function () {
    return response()->download(public_path('versions/app-release.apk'), 'app-release.apk', [        'Content-Type' => 'application/vnd.android.package-archive'    ]);
});

Route::post('comprobaruser', [UsuarioController::class, 'comprobaruser'])->middleware('firstValidation');
Route::post('selectuser', [UsuarioController::class, 'show'])->middleware('firstValidation');
Route::middleware(['auth:api'])->get('reportefumigacion', [fumigacioncontroller::class, 'reportefumigacion']);
Route::middleware(['auth:api'])->get('reportedatosplanta', [datosplantacontroller::class, 'store']);


