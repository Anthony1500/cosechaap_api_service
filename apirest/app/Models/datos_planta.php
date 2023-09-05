<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class datos_planta extends Model
{
   
    use HasFactory, Notifiable;
    protected $table= "datos_plantas";

    function enviarDatosFechaActual(){
    date_default_timezone_set("America/Guayaquil");
    $Date = date('Y-m-d', time());
    $datosPlanta = DB::table('datos_plantas')
        ->select('*')
        ->where('fecha',$Date)
        ->get();

    return $datosPlanta;
}

}
