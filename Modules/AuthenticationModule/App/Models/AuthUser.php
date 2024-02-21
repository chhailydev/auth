<?php

namespace Modules\AuthenticationModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\AuthenticationModule\Database\factories\AuthUserFactory;

class auth_user extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'email', 'password'];
    
    protected static function newFactory()
    {
        
    }
}
