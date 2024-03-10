<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class MakeOrderRequest extends Data
{
    public function __construct(
        #[DataCollectionOf(OrderItemRequest::class)]
        public readonly DataCollection $items,
        public readonly string $shippingMethodId,
        public readonly string $paymentMethod,

    ) {
    }
}
