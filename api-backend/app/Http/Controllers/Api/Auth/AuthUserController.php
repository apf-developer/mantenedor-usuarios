<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthUserController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'name'     => 'required|string|min:5|max:50',
            'email'    => 'required|string|email|unique:users',
            'password' => ['required', Password::min(8)->max(50)->mixedCase()->letters()->numbers()->symbols()->uncompromised(), 'confirmed']
        ];

        //Valida la informacion recibida
        $validator = Validator::make($request->all(), $rules);
 
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 400);
        }
    
        // Recupera los datos de entrada y crea el usuario
        $newUser = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password
        ]);

        //Exitoso
        return response()->json([
            'status' => true,
            'token'  => $newUser->createToken('token')->plainTextToken,
            'msg'    => 'Registro de usuario exitoso.'
        ], 201);
    }

    public function login(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required'
        ];

        //Valida la informacion recibida
        $validator = Validator::make($request->all(), $rules);
 
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 400);
        }

        $credentials = $request->validate($rules);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => false,
                'errors' => ['error' => ['Credenciales incorrectas.']]
            ], 401);
        }

        //Exitoso
        $user = User::where('email', $request->email)->first();
        return response([
            'status'   => true,
            'userData' => $user,
            'token'    => $user->createToken('token')->plainTextToken,
            'msg'      => 'Inicio de sesión exitoso.'
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'status' => true,
            'msg' => 'Sesión cerrada exitosamente.'
        ], 200);
    }
}
