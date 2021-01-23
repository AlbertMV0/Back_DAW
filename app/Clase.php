<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{

    public function Profesor(){
        return $this->hasOne(Profesor::class,'id_profesor');
    }

    protected $table = 'clase';
    protected $primaryKey = 'id_clase';
    public $timestamps = false;
}
