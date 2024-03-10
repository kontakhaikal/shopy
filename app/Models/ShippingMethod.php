<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property string name
 * @property int cost
 */
class ShippingMethod extends Model
{
    use HasUuids;

    public function shippingOption()
    {
        return $this->belongsTo(ShippingOption::class);
    }

    public function shippings()
    {
        return $this->hasMany(Shipping::class);
    }
}
