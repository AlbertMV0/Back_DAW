<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use App\Profesor;
use App\User;
use App\Alumno;
use App\Padre;
use App\Alumno_padre;

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
                $user->alumnos=$children;
                }
            }else if($user->nivel==1){
                $profesor=Profesor::find($user->id);
                $user->clase=Clase::where('id_profesor', $profesor{'id_profesor'})->first(){'nombre_clase'};
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
        return response()->json($request->user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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