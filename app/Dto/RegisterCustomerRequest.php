<?php

namespace App\Dto;

use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\Validation\Password;
use Spatie\LaravelData\Data;

class RegisterCustomerRequest extends Data
{
    function __construct(
        #[Between(3, 12)]
        public readonly string $username,
        #[Password(12, true, true, true, true)]
        public readonly string $password
    ) {
    }
}
