<?php

namespace App\Models;

use App\Exceptions\InsufficientProductStockException;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUlids, HasFactory;

    protected $table = "products";

    protected $fillable = [
        'name',
        'picture',
        'price',
        'stock'
    ];

    public function getStock(): int
    {
        return $this->stock;
    }

    public function reduceStock(int $amount)
    {
        if ($amount > $this->stock) {
            throw new InsufficientProductStockException();
        }
        return $this->stock -= $amount;
    }
}
