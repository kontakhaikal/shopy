<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\Validation\Ulid;
use Spatie\LaravelData\Data;

class AddCartItemRequest extends Data
{
    public function __construct(
        #[Ulid()]
        public readonly string $productId
    ) {
    }
}
