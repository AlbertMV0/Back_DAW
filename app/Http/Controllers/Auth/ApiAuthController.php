<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Profesor;
use App\Padre;
use App\Alumno;
use App\Clase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'apellidos' => 'required|string|max:200',
            'telefono' => 'numeric|required',
            'direccion' => 'string|max:200|required',
            'nivel' => 'required'
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        //$habilitado=['habilitado'=>0];
        //array_push($request->toArray(), $habilitado);
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        if($request->toArray(){'nivel'}==0){
            Padre::create(['id_padre'=>$user->id]);
        }else{
            Profesor::create(['id_profesor'=>$user->id]);
        }

        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token,'UsuarioCreado'=>$user,'datos'=>($request->toArray())];
        return response($response, 200);
    }
    public function registerAlumno (Request $request) {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'apellidos' => 'required|string|max:200',
            'edad' => 'required|numeric',
            'genero' => 'string|max:50',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        //$habilitado=['habilitado'=>0];
        //array_push($request->toArray(), $habilitado);
      
        $id_clase=$request->toArray(){'id_clase'};

        if($id_clase!="" && $id_clase!=null){
            $clase=Clase::find($id_clase)->first();
            if($clase==null){
                return response(['errors'=>"La clase con el id introducido no existe"], 422);
            }else{
                $alumno = Alumno::create($request->toArray());
            }
        }

       
        $response = ['Alumno'=>$alumno];
        return response($response, 200);
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['user' =>$user,'token'=>$token];
                return response()->json($response,200);
            } else {
                $response = ["message" => "Contraseña incorrecta"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'El usuario no existe'];
            return response($response, 422);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'Has cerrado sesión correctamente'];
        return response($response, 200);
    }
}
