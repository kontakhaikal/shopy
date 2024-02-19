<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class CartDto extends Data
{
    public function __construct(
        public readonly string $id,
        #[DataCollectionOf(CartItemDto::class)]
        public readonly DataCollection $items
    ) {
    }
}
