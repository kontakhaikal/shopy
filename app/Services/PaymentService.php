<?php

namespace App\Services;

use App\Dto\CreatePaymentRequest;
use App\Dto\PaymentDto;

interface PaymentService
{
    public function createPayment(string $customerId, CreatePaymentRequest $request): PaymentDto;
}
