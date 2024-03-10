<?php

namespace App\Services;

use App\Dto\TopUpWalletRequest;
use App\Dto\WalletDto;

interface WalletService
{
    public function createWallet(string $customerId): string;
    public function getWallet(string $customerId): WalletDto;
    public function topUpWallet(string $customerId, TopUpWalletRequest $request): WalletDto;
    public function pay(string $customerId, int $amount);
}
