<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $listUsers = User::all();

        if ($listUsers->isEmpty()) {
            $data = [
                'msg' => 'No se encontraron usuarios registrados.',
                'status' => false
            ];
            return response()->json($data, 404);
        }

        //Exitoso
        $data = [
            'status' => true,
            'users' => $listUsers
        ];
        return response()->json($data, 200);
    }

    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'status' => false,
                'msg' => 'Usuario no encontrado.',
            ];
            return response()->json($data, 404);
        }

        //Exitoso
        $data = [
            'status' => true,
            'user' => $user,
        ];
        return response()->json($data, 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            $data = [
                'msg' => 'Usuario no encontrado.',
                'status' => false,
            ];
            return response()->json($data, 404);
        }

        //Valida la informacion recibida
        $rules = [
            'name' => 'required|string|min:5|max:50',
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($id)],
        ];
        $validator = Validator::make($request->all(), $rules);
 
        if ($validator->fails()) {
            $data = [
                'msg' => 'Error en la validación de los datos.',
                'errors' => $validator->errors(),
                'status' => true
            ];
            return response()->json($data, 400);
        }

        //Exitoso
        //Aplica cambios
        $user->fill([
            'name' => $request->name,
            'email' => $request->email
        ]);
        $user->save();

        $data = [
            'msg' => 'Usuario actualizado.',
            'user' => $user,
            'status' => true
        ];
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            $data = [
                'msg' => 'Usuario no encontrado.',
                'status' => false,
            ];
            return response()->json($data, 404);
        }

        //Exitoso
        $user->delete();
        $data = [
            'msg' => 'Usuario eliminado.',
            'status' => true,
        ];
        return response()->json($data, 200);
    }
}
