<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property ShippingMethod method
 */
class Shipping extends Model
{
    use HasUuids;

    public function setOrder(Order $order)
    {
        $this->order_id = $order->id;
    }

    public function setShippingMethod(ShippingMethod $shippingMethod)
    {
        $this->shipping_method_id = $shippingMethod->id;
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function method()
    {
        return $this->belongsTo(ShippingMethod::class, 'shipping_method_id', 'id');
    }
}
