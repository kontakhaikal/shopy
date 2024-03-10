<?php

namespace App\Services;

use App\Dto\CreatePaymentRequest;
use App\Dto\PaymentDto;
use App\Dto\PaymentMethod;
use App\Dto\PaymentStatus;
use App\Exceptions\UnsupportedPaymentMethodException;

class PaymentServiceImpl implements PaymentService
{
    public function __construct(
        private readonly WalletService $walletService
    ) {
    }
    public function createPayment(string $customerId, CreatePaymentRequest $request): PaymentDto
    {
        switch ($request->method) {
            case PaymentMethod::WALLET;
                $this->walletService->pay($customerId, $request->amount);
                return new PaymentDto(PaymentStatus::PAID);
            default:
                throw new UnsupportedPaymentMethodException();
        }
    }
}
