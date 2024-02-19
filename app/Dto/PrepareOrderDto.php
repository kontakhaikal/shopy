<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class PrepareOrderDto extends Data
{
    public function __construct(
        #[DataCollectionOf(PrepareOrderItemDto::class)]
        public readonly DataCollection $items
    ) {
    }
}
