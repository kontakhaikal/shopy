<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class OrderItemDto extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly ProductDto $product,
        public readonly int $quantity,
        public readonly int $price
    ) {
    }
}
