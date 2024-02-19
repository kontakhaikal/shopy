<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class PrepareOrderItemRequest extends Data
{
    public function __construct(
        public string $productId,
        public int $quantity,
    ) {
    }
}
