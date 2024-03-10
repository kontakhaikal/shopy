<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class ShippingMethodDto extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly int $cost
    ) {
    }
}
