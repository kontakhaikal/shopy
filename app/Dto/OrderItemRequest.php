<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class OrderItemRequest extends Data
{
    public function __construct(
        public readonly string $productId,
        public readonly int $quantity
    ) {
    }
}
