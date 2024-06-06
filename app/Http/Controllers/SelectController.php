<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Rol;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function roles()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

    public function cargos()
    {
        $cargos = Cargo::all();
        return response()->json($cargos);
    }
}
