<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $fillable = [ 
        'fecha', 'id_alumno', 'comentario'
    ];

    protected $table = 'comentario';
    protected $primaryKey = 'id_comentario';
    public $timestamps = false;
}
