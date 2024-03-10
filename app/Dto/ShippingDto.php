<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class ShippingDto extends Data
{
    public function __construct(
        public readonly ShippingMethodDto $method,
    ) {
    }
}
