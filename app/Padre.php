<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{

    public function alumnos(){
        return $this->belongsToMany(Alumno::class, 'alumno_padre','id_padre','id_alumno');
    }

    protected $fillable = [ 
        'id_padre', 'estado', 'estado_civil'
    ];

    protected $table = 'padre';
    protected $primaryKey = 'id_padre';
    public $timestamps = false;
}
