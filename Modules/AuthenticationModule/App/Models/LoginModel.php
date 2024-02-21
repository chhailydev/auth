<?php

namespace Modules\AuthenticationModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AuthenticationModule\Database\factories\LoginModelFactory;

class LoginModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory()
    {
        //return LoginModelFactory::new();
    }
}
