<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{

    protected $fillable = [ 
        'nombre', 'apellidos', 'edad','aficiones','genero','id_clase'
    ];


    public function padres(){
        return $this->belongsToMany(Padre::class, 'alumno_padre');
    }

    public function Clase(){
        return $this->hasOne(Clase::class,'id_clase');
    }

    protected $table = 'alumno';
    protected $primaryKey = 'id_alumno';
    public $timestamps = false;
    
}
