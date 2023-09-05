<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Validation\Validator;
use Dotenv\Validator as DotenvValidator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usuariocontroller extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuarios2()
    {
    $usuarios = Usuario::get();
    return response()->json($usuarios,200);
          
   
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
     public function login(Request $request)
    {
$validateData = $request->validate([
    'email'=> 'required',
    'password'=> 'required',
    'token' => 'required',
]);
$validateData['password'] = Hash::make($request->password);
$user = User::where('email', $validateData['email'])->first();
if (!$user) {
    
    $user = User::create($validateData);
}

$credentials = $request->only('email', 'password');
if (Auth::attempt($credentials)) {
    $user = Auth::user();
    $accessToken = $user->createToken('authToken')->accessToken;
     $usuarioautentico= Usuario::where('email',$request->email)->where('password',$request->password)->firstOrFail();
    return response()->json([
        'user' =>  $usuarioautentico,
        'access_token' => $accessToken,
        'token_type' => 'Bearer'
    ], 200);
} else {
    return response()->json(['error' => 'Email y/o contraseña incorrectos'], 401);
}    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comprobaruser(Request $request)
    {
 $validateData = $request->validate([
    'username'=> 'required',
    
]);
$user = Usuario::where('username', $validateData['username'])->first();
 return response()->json([
        'user' => $user
        
    ], 200);
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         if (!$request->input('id_usuario')) {
            return response()->json(['error' => 'Campo requerido'], 422);
        }
    // Esta línea busca un usuario en la base de datos según el id especificado.
    $usuario = Usuario::where('id_usuario', $request->id_usuario)->firstOrFail();

    // Esta línea comprueba si el usuario existe. Si no existe, devuelve un código de error 404.
     if (!$usuario) {
    return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Esta línea devuelve los datos del usuario con un código de respuesta 200.
    return response()->json($usuario, 200);
    }

    public function comprobar(Request $request)
    {
         if (!$request->input('username')) {
            return response()->json(['error' => 'Campo requerido'], 422);
        }
    // Esta línea busca un usuario en la base de datos según el id especificado.
    $usuario = Usuario::where('username', $request->input('username'))->firstOrFail();

    // Esta línea comprueba si el usuario existe. Si no existe, devuelve un código de error 404.
     if (!$usuario) {
    return response()->json(['error' => 'Usuario no encontrado'], 404);
    }else{
    // Esta línea devuelve los datos del usuario con un código de respuesta 200.
    return response()->json($usuario,200);
   
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if (!$request->input('id_usuario') || !$request->input('privilegio')) {
            return response()->json(['error' => 'Todos los campos son requeridos'], 422);
        }
        $usuarios = Usuario::find($request->input('id_usuario')); // Se modifica la línea para usar el método find en lugar de where.

        if (!$usuarios) {
        return response()->json(['error' => 'El usuario no existe'], 422);
        }
        $usuarios->privilegio = $request->input('privilegio'); // Se agrega esta línea para asignar el nuevo privilegio al usuario.
         // Se agrega esta línea para guardar los cambios realizados en el usuario.

         try {
       // $usuarios->updatePrivilegio();
        Usuario::updatePrivilegio($request->input('id_usuario'),$request->input('privilegio'));
        } catch (\Throwable $th) {
        return response()->json(['error' => 'El usuario no se guardo'], 422);
        }
        return response()->json(['success' => 'El usuario se actualizó con éxito'], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
    $validateData = $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $user = User::where('email', $validateData['email'])->first();
    if ($user && Hash::check($validateData['password'], $user->password)) {
       Auth::guard('api')->user()->token()->delete();
        return response()->json(['message' => 'Sesión cerrada correctamente'], 200);
    } else {
        return response()->json(['error' => 'Email y/o contraseña incorrectos'], 401);
    }
}
    
}
