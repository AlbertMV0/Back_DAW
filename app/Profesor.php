<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $fillable = [ 
        'id_profesor', 'id_clase', 'experiencia'
    ];


    protected $table = 'profesor';
    protected $primaryKey = 'id_profesor';
    public $timestamps = false;
}
