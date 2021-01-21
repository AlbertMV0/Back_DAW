<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class UsuarioController extends Controller
{
   public function getAllUsuarios(){
     // return response()->json(Usuario::get(),200);
    return Usuario::all();
   }
}
