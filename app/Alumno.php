<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{

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
