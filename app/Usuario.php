<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
use Notifiable, HasApiTokens;

    protected $table = 'usuario';
    protected $primaryKey='id_usuario';
}
