<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string id
 * @property int price
 * @property int quantity
 */
class OrderItem extends Model
{
    use HasUuids;

    protected $table = "order_items";

    public function setOrder(Order $order)
    {
        $this->order_id = $order->id;
    }
    public function setProduct(Product $product)
    {
        $this->product_id = $product->id;
    }

    public function setPrice(int $price)
    {
        $this->price = $price;
    }

    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
