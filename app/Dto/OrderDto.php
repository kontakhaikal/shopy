<?php

namespace App\Dto;

use App\Models\OrderStatus;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class OrderDto extends Data
{
    public function __construct(
        public readonly string $id,
        #[DataCollectionOf(OrderItemDto::class)]
        public readonly DataCollection $items,
        public readonly OrderStatus $status,
        public readonly ShippingDto $shipping,
    ) {
    }
}
