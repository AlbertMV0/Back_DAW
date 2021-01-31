<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Clase;
use App\User;
use App\Comentario;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $alumnos=Alumno::all();
        foreach($alumnos as $alumno){
            $alumno->clase= $clase=Clase::find($alumno->id_clase){'nombre_clase'};
        }
        return response($alumnos);
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
        $permiso=false;
        $alumno=Alumno::where('id_alumno',$request->id)->first();
        $user=$request->user();
        if ($user->nivel ==0){
            $hijo=Alumno_padre::where('id_padre',$user->id)->where('id_alumno',$request->id)->first();
            if(!empty($hijo)){
                $permiso=true;
            }
        }else if($user->nivel==1){
            $clase=Clase::find($alumno['id_clase']);
            if(!empty($clase)){
                $permiso=true;
            }
        }else if($user->nivel==2) {
            $permiso=true;
        }
       
        if($permiso){
            return response(['alumno'=>$alumno], 200);
        }else{
            return response(['errors'=>"Acceso del alumno no válido"], 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'string|max:50',
            'apellidos' => 'string|max:200',
            'edad' => 'numeric',
            'genero' => 'max:50',
            'aficiones' => 'string|max:200',
            'alergias' => 'string|max:200',
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

    public function crearComentario(Request $request)
    {
        $fecha=date('Y-m-d');
        $comentario=array('fecha'=>$fecha,'comentario'=>$request->comentario
    ,'id_alumno'=>$request->id_alumno);
        
        $comentario = Comentario::create($comentario);
        return response($comentario, 200);
    }

    public function verComentarios(Request $request)
    {
        $comentarios=Comentario::where('id_alumno',$request->id_alumno)->get();
        
        return response($comentarios, 200);
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
