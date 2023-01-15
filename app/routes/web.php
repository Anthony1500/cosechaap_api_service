<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\fumigaciones;
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
Route::get('/', function () {
    //return view('welcome');
    return 'Bienvenido a todos los presentes';
});
//middleware(['auth'])->
Route::controller(fumigaciones::class)->group(function () {

    Route::get('selectfumigacion','selectfumigacion');
    Route::get('selectfumigacionactual','selectfumigacionactual');
    Route::put('selectfumigacioneditar/{id}','selectfumigacioneditar');

});

