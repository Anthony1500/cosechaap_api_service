<?php

namespace App\Models;

use Database;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
class Usuario extends Model
{
    use HasFactory, Notifiable;
    protected $table= "usuarios";
 
// Método para actualizar el previlegio
public static function updatePrivilegio($id_usuario,$privilegio) {
    $returnValue = DB::table('usuarios')
    ->where('id_usuario', '=',$id_usuario )
    ->update(['privilegio' => $privilegio,]);
     return $returnValue;
}
// Método find()
public static function find($id_usuario) {
    return self::where('id_usuario', $id_usuario)->first();
}

public static function findusuario($email,$password) {
    $returnValue= DB::table('usuarios')
    ->where('email', '=', $email)->
      where('password', '=', $password);
      return $returnValue;

}

}

