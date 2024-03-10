<?php

namespace App\Dto;

class PaymentDto
{
    public function __construct(
        public readonly PaymentStatus $status,
    ) {
    }
}
