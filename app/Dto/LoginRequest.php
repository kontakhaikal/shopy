<?php

namespace App\Dto;

use Spatie\LaravelData\Data;

class LoginRequest extends Data
{
    function __construct(
        public readonly string $username,
        public readonly string $password,
        public readonly bool $remember
    ) {
    }
}
