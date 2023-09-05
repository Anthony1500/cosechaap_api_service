<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
class Fumigacione extends Model
{
    use HasFactory, Notifiable;
    
   protected $fillable = [
        'fecha', 'hora', 'invernadero', 'tratamiento', 'encargado'
    ];

    protected $table = 'fumigaciones';
    
public static function updateFumigacion($id, $data) {
    $returnValue = DB::table('fumigaciones')
    ->where('id','=',$id)->update($data);
    return $returnValue;
}
public static function deleteFumigacion($id) {
    $returnValue = DB::table('fumigaciones')
    ->where('id','=',$id)->delete();
    return $returnValue;
}
}
