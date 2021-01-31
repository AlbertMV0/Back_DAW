<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use App\Profesor;
use App\User;
use App\Alumno;

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
        $clase=Clase::find($request->id);
        
            //$clase->profesor;
            $user=User::find($clase->id_profesor);
            $clase->prof=$user{'name'};
            $clase->alumnos=Alumno::where('id_clase',$clase->id_clase)->get();
        
        
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

        if($request->nombre!="null"){
            $class['nombre_clase']=$request->nombre_clase;
        }

        if($request->id_profesor!=null){
            $profesor=Profesor::find($request->id_profesor);
        if($profesor!=null){
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