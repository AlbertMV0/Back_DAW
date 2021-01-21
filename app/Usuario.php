<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Usuario extends Authenticatable  
{
use Notifiable, HasApiTokens;

    
//protected $fillable =['nombre','apellidos','email','password']; 

    protected $table = 'usuario';
    protected $primaryKey='id_usuario';
}
