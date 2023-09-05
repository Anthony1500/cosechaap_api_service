<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Usuario;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class firstValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
// Obtener las credenciales del usuario

        $tokenapi = env('APP_TOKEN');
        $email    = $request->input('email');
        $password = $request->input('password');
        $token    = $request->input('token');
        if ($tokenapi != $token) {
        // Devolver un código de estado 401 (no autorizado) si el token es incorrecto
        return response()->json(['error' => 'Token invalid'], 401);
        }

         // Verificar las credenciales en la base de datos
         try {
             Usuario::where('email',$email)->where('password',$password)->firstOrFail();

             } catch (\Throwable $th) {
             return response()->json(['error' => 'El usuario no se encontro'], 422);
             }

        // Continuar con la solicitud si las credenciales son válidas
        return $next($request);
    }
}
