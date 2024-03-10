<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class ShippingOptionRequest extends Data
{
    public function __construct(
        public readonly string $optionId,
        public readonly string $methodId
    ) {
    }
}
