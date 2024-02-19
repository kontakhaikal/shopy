<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class CartItemDto extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly ProductDto $product,
        public readonly int $quantity,
        public readonly bool $selected
    ) {
    }
}
