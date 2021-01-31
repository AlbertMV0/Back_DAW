<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use App\Profesor;
use App\User;
use App\Alumno;
use App\Padre;
use App\Alumno_padre;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
 
        foreach($users as $user){
            if ($user->nivel==0) {;
                $padre=Padre::find($user->id);
                if(!empty($padre)){
                $hijos=Alumno_padre::where('id_padre',$user->id)->get();
                $children=[];
                if(count($hijos)>0){
                    foreach($hijos as $hijo){
                        $alumno=array(
                            'nombre'=>(Alumno::find($hijo['id_alumno'])['nombre']),
                            'id_alumno'=>(Alumno::find($hijo['id_alumno'])['id_alumno']),
                            );
                        array_push($children,$alumno);
                    }
                }
                $user->tipo="Padre";
                $user->alumnos=$children;
                }
            }else if($user->nivel==1){
                $profesor=Profesor::find($user->id);
                $user->clase=Clase::where('id_profesor', $profesor{'id_profesor'})->first(){'nombre_clase'};
                $user->tipo="Profesor";
            }
        }
        return response($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user=$request->user();
        if ($user->nivel ==0){
            $hijos=Alumno_padre::where('id_padre',$user->id)->get();
            $children=[];
            if(count($hijos)>0){
                foreach($hijos as $hijo){
                    $alumno=array(
                        'nombre'=>(Alumno::find($hijo['id_alumno'])['nombre']),
                        'id_alumno'=>(Alumno::find($hijo['id_alumno'])['id_alumno']),
                        'id_clase'=>(Alumno::find($hijo['id_alumno'])['id_clase']),
                        );
                    array_push($children,$alumno);
                }
            $user->tipo="Padre";
            $user->alumnos=$children;
            }
        }else if($user->nivel==1){
            $user->clase=Clase::where('id_profesor', $user->id)->first();
        }
       
    
        return response()->json($user);
    
    }   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $user=User::find($request->id);
        if($request->name!=null){
            $user['name']=$request->name;
        }
        if($request->email!=null){
            $user['email']=$request->email;
        }
        if($request->password!=null){
            $request['password']=Hash::make($request['password']);
            $user['password']= $request['password'];
        }
        if($request->apellidos!=null){
            $user['apellidos']=$request->apellidos;
        }
        if($request->telefono!=null){
            $user['telefono']=$request->telefono;
        }
        if($request->direccion!=null){
            $user['direccion']=$request->direccion;
        }
        if($request->experiencia!=null){
            $profesor=Profesor::find($user['id']);
            $profesor['experiencia']=$request->experiencia;
        }
        if($request->estado_civil!=null){
            $padre=Padre::find($user['id']);
            $padre['estado_civil']=$request->estado_civil;
        }
        

        if(!empty($request->id_alumno)){
            $alumno=Alumno::find($request->id_alumno);
            if(!empty($alumno)){
                $alumno_padre=array('id_padre'=>$user['id'],'id_alumno'=>$alumno['id_alumno']);
                $comentario = Alumno_padre::create($alumno_padre);
            }else{
                return response(['errors'=>"Ese alumno no existe"], 422);
            }
        }

        $user->save();

        return response($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}