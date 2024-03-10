<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticableContract;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticableContract
{
    use HasUuids, Authenticatable;

    protected $table = "users";

    protected $casts = [
        'password' => 'hashed'
    ];

    protected $hidden =  [
        'pasword', 'remember_token'
    ];
}
