<?php

namespace App\Services;

use App\Dto\RegisterCustomerRequest;

interface CustomerService
{
    function register(RegisterCustomerRequest $request): string;
}
