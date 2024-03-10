<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class CreatePaymentRequest extends Data
{
    public function __construct(

        public readonly int $amount,
        public readonly PaymentMethod $method
    ) {
    }
}
