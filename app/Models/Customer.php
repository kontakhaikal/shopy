<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

/**
 * @property string $id
 * @property string $username
 * @property string $passsword
 */
class Customer extends User
{
    use HasUuids;

    protected $table = "users";

    protected $casts = [
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($customer) {
            $customer->role = 'customer';
        });
        static::addGlobalScope('role', function (Builder $builder) {
            $builder->where('role', 'customer');
        });
    }
}
