<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;

use function Laravel\Prompts\password;

class ProfileController extends Controller
{
    public function updateNameEmail(Request $request)
    {
        $user = auth()->user();

        //Valida la informacion recibida
        $rules = [
            'name' => 'required|string|min:5|max:50',
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($user->id)],
        ];
        $validator = Validator::make($request->all(), $rules);
 
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => true
            ], 400);
        }

        //Exitoso
        //Aplica cambios
        $user->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);
        $user->save();

        return response()->json([
            'msg' => 'Usuario actualizado.',
            'user' => $user,
            'status' => true
        ], 200);
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        //Valida la informacion recibida
        $rules = [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::min(8)->max(50)->mixedCase()->letters()->numbers()->symbols()->uncompromised(), 'confirmed']
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => true
            ], 400);
        }

        //Valida contraseña antigua versus la nueva
        if (Hash::check($request->password, $user->password)) {
            return response()->json([
                'errors' => ['password' => ['La nueva contraseña no puede ser igual a la contraseña actual.']],
                'status' => true
            ], 400);
        }
        
        //Exitoso
        //Aplica cambios
        $request->user()->update([
            'password' => $request->password
        ]);

        return response()->json([
            'status' => true,
            'msg' => 'Contraseña actualizada.',
        ], 200);
    }
}
