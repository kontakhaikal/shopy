<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class PrepareOrderItemDto extends Data
{
    public function __construct(
        public readonly ProductDto $product,
        public readonly int $quantity
    ) {
    }
}
