<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    public function Clase(){
        return $this->hasOne(Clase::class,'id_clase');
    }

    protected $table = 'alumno';
    protected $primaryKey = 'id_alumno';
    public $timestamps = false;
    
}
