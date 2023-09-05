<?php

use App\Http\Controllers\datosplantacontroller;
use Illuminate\Http\Request;
use App\Http\Controllers\fumigacioncontroller;
use App\Http\Controllers\usuariocontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [Usuariocontroller::class, 'login'])->middleware('firstValidation');

Route::middleware(['auth:api'])->controller(fumigacioncontroller::class)->group(function () {
   
     Route::post('agregarfumigacion','agregarfumigacion');
     Route::post('selectfumigacion','index');
     Route::post('selectfumigacionactual','selectfumigacionactual');
     
     Route::put('editarfumigacion','editarfumigacion');
     Route::post('selectfumigacioneditar','selectfumigacioneditar');
    Route::post('eliminarfumigacion','eliminarfumigacion');
 });
 Route::middleware(['auth:api'])->controller(usuariocontroller::class)->group(function () {
  
   // V
    
    Route::post('selectusuarios2','usuarios2');
     Route::post('selectusuarios','show');
     Route::put('actualizar','update');
     Route::post('comprobar','comprobar');
     Route::post('logout','logout');
 });
 Route::middleware(['auth:api'])->controller(datosplantacontroller::class)->group(function () {
      Route::post('selecttemperaturas','index');
      Route::post('selectsensado','selectsensado');
  });
  
  

