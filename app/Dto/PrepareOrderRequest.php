<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PrepareOrderRequest extends Data
{
    public function __construct(
        #[DataCollectionOf(PrepareOrderItemRequest::class)]
        public readonly DataCollection $items
    ) {
    }
}
