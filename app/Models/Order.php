<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property Collection<OrderItem> items
 * @property Shipping shipping
 */
class Order extends Model
{
    use HasUuids;

    protected $table = "orders";

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }

    public function calculateTotalPrice(): int
    {
        return $this->shipping->method->cost + $this->calculateItemsPrice();
    }

    private function calculateItemsPrice(): int
    {
        return $this->items->reduce(function (?int $total, OrderItem $item) {
            return $item->price * $item->quantity + $total;
        });
    }

    public function setStatus(OrderStatus $status)
    {
        $this->status = $status->value;
    }
}
