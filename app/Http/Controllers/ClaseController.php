<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use App\Profesor;
use App\User;
use App\Alumno;
use App\Alumno_padre;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clases=Clase::All();
        foreach($clases as $clase){
            $user=User::find($clase->id_profesor);
            $clase->prof=$user{'name'};
            //$clase->prof=Profesor::where('id_profesor',$clase->id_profesor)->first();
        }
        
        return response($clases);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $clase=Clase::find($request->id_clase);
        $permiso=false;
        $clase->alumnos=Alumno::where('id_clase',$clase->id_clase)->get();
        //Comprobamos que el usuario esta accediendo a una clase donde tiene hijos matriculados
        if($user['nivel']==0){
            $hijos=Alumno_padre::where('id_padre',$user['id'])->get();
            $alumnos=Alumno::where('id_clase',$clase['id_clase'])->get();
            if($hijos!="null" && $alumnos!="null"){
                foreach ($hijos as $hijo) {
                    foreach ($alumnos as $alumno){
                       if($hijo['id_alumno']==$alumno['id_alumno']){
                           $permiso=true;
                       }
                    }
                }
            }
        }
        
        //Comprobamos que el profesor sea el de la clase a la que se accede
        if($user['id']==$clase['id_profesor']){
            $permiso=true;
        }
           
        if($permiso==false){
            return response(['errors'=>"No tienes permiso para acceder a esta clase"], 422);
        }
        
        $clase->profesor=User::find($clase['id_profesor']);

        return response($clase);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $class=Clase::find($request->id_clase);

        if($request->nombre_clase!="null"){
            $class['nombre_clase']=$request->nombre_clase;
        }

        if($request->id_profesor!="null"){
            return response($class, 200);

            $profesor=Profesor::find($request->id_profesor);
            if($profesor!="null"){
                $clases=Clase::all();
                foreach ($clases as $clase) {
                    if($clase['id_profesor']==$request->id_profesor){
                        return response(['errors'=>"Ese profesor ya tiene otra clase. Introduce un profesor válido"], 422);
                    }
                }
            $class['id_profesor']=$request->id_profesor;  
            }else{
                return response(['errors'=>"Ese profesor no existe"], 422);
            }
        }

        $class->save();
        return response($class, 200);
        
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