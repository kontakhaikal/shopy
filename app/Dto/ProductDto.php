<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class ProductDto extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly int $price,
        public readonly int $stock,
        public readonly string $picture
    ) {
    }
}
