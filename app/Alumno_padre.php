<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno_padre extends Model
{
    protected $fillable = [ 
        'id_padre', 'id_alumno'
    ];
    
    protected $table = 'alumno_padre';
    protected $primaryKey = 'id_alumno_padre';
    public $timestamps = false;
}
