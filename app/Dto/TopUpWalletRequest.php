<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Data;

class TopUpWalletRequest extends Data
{
    public function __construct(
        #[In(50_000, 100_000, 150_000, 200_000, 300_000, 400_000, 500_000)]
        public readonly int $amount
    ) {
    }
}
