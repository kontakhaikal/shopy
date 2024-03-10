<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class WalletDto extends Data
{
    public function __construct(
        public readonly string $id,
        public readonly int $balance
    ) {
    }
}
