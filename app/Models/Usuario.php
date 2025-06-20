<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Schema\Blueprint;

class Usuario extends Authenticatable
{
    use HasFactory;
    protected $table = 'cadastrousers';
     protected $fillable = ['email', 'senha'];
    
}
