<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id;
 * @property string name;
 */
class ShippingOption extends Model
{
    use HasUuids;

    public function methods()
    {
        return $this->hasMany(ShippingMethod::class);
    }
}
