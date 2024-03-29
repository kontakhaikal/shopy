<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property int balance
 */
class Wallet extends Model
{
    use HasUuids;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
