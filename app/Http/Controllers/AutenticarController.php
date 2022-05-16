<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Http\Requests\Registrorequest;
use App\Http\Requests\AccesoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;



class AutenticarController extends Controller
{
    //
    public function registro(Registrorequest $request){
        $user = new User();
        $user->Codigo_SIS_U= $request->Codigo_SIS_U;
        $user->Nombre_U= $request->Nombre_U;
        $user->Contrasenia_U= $request->Contrasenia_U;
        $user->Correo_U= $request->Correo_U;
        $user->Apellido_Paterno_U= $request->Apellido_Paterno_U;
        $user->Apellido_Materno_U= $request->Apellido_Materno_U;
        $user->Rol_U= $request->Rol_U;
        $user->save();

        return response()->json([
            'res'=>true,
            'msg'=> 'UEl usuario se ha registrado correctamente '
        ],200);
    }
    public function acceso(AccesoRequest $request){
        $user = User::where('Correo_U', $request->Correo_U)->first();
        $user2 = User::where('Contrasenia_U', $request->Contrasenia_U)->first();
        if (! $user || ! $user2) {
            throw ValidationException::withMessages([
                'msg' => ['El usuario no existe o es incorrecto'],
            ]);
        }
    
        $token =  $user->createToken($request->Correo_U)->plainTextToken;
        return response()->json([
            'res' => true,
            'correo' => $user->Correo_U,
            'nombre' => $user->Nombre_U,
            'codigosis' => $user->Codigo_SIS_U,
            'apellido_paterno' => $user->Apellido_Paterno_U,
            'apellido_materno' => $user->Apellido_Materno_U,
            'rol'=>$user->Rol_U,
            'token'=> $token
        ],200);
    }

    public function cerrarSesion(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'res' => true,
            'msg'=> 'el token de autenticacion a sido eliminado'
        ],200);
    }
    public function index()
    {
        $users = DB::table('users')->get();
 
        return $users;
        // return User::all();
    }
   

}

