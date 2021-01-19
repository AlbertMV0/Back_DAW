<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    protected $table = 'alumno';    
    protected $primaryKey='id_alumno';

    public function comentarios()
    {
        return $this->hasMany('App\Comentario','fecha');
    }

    public function padre()
    {
        return $this->hasMany('App\Alumno_padre','id_alumno_padre');
    }

    public function clase()
    {
        return $this->hasOne('App\Clase','id_clase');
    }
}
