<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Padre extends Model
{
    protected $table = 'padre';
    protected $primaryKey = 'id_padre';
    public $timestamps = false;
}
