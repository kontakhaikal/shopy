<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class ShippingOptionDto extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        #[DataCollectionOf(ShippingMethodDto::class)]
        public readonly DataCollection $methods
    ) {
    }
}
