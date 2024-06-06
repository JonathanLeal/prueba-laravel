<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function mostrarUsuarios()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['validacion' => 'usuario no logueado'], 402);
        }

        $usuarios = DB::table('users AS u')
                    ->join('cargos AS c', 'u.idCargo', '=', 'c.id')
                    ->join('roles AS r', 'u.idRol', '=', 'r.id')
                    ->select('u.id', 'u.name', 'u.email', 'u.estado', 'c.cargos', 'r.roles')
                    ->get();
        return response()->json($usuarios);
    }

    public function agregarUsuario(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['validacion' => 'usuario no logueado'], 401);
        }

        $validator = Validator::make($request->all(), [
            'usuario'  => 'required|string',
            'email'    => 'required|email',
            'password' => 'required|string',
            'rol'      => 'required|int',
            'cargo'    => 'required|int'
        ]);

        if ($validator->fails()) {
            return response()->json(['mensaje' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $rol = Rol::where('id', $request->rol)->first();
            $cargo = Cargo::where('id', $request->cargo)->first();

            $user = new User();
            $user->name     = $request->usuario;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->idRol    = $rol->id;
            $user->idCargo  = $cargo->id;
            $user->estado   = "ACTIVO"; 
            $user->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
        DB::commit();
        return response()->json(['mensaje' => 'usuario registrado con exito']);
    }

    public function eliminarUsuario($id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['validacion' => 'usuario no logueado'], 401);
        }

        $user = User::where('id', $id)->first();
        $user->delete();
    }

    public function editarUsuario(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['validacion' => 'usuario no logueado'], 401);
        }

        $validator = Validator::make($request->all(), [
            'usuario'  => 'required|string',
            'email'    => 'required|email',
            'password' => 'nullable|string',
            'rol'      => 'required|int',
            'cargo'    => 'required|int'
        ]);

        if ($validator->fails()) {
            return response()->json(['mensaje' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $rol = Rol::where('id', $request->rol)->first();
            $cargo = Cargo::where('id', $request->cargo)->first();

            $user->name = $request->usuario;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->idRol = $rol->id;
            $user->idCargo = $cargo->id;
            $user->estado = "ACTIVO";
            $user->save();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }
        DB::commit();
        return response()->json(['mensaje' => 'usuario actualizado con exito']);
    }

    public function seleccionar($id)
    {
        $usuarios = DB::table('users AS u')
                    ->join('cargos AS c', 'u.idCargo', '=', 'c.id')
                    ->join('roles AS r', 'u.idRol', '=', 'r.id')
                    ->select('u.id', 'u.name', 'u.email', 'u.estado', 'c.cargos', 'r.roles')
                    ->where('u.id', $id)
                    ->first();
        return response()->json($usuarios);
    }
}
