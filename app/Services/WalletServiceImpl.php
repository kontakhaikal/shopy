<?php

namespace App\Services;

use App\Dto\TopUpWalletRequest;
use App\Dto\WalletDto;
use App\Exceptions\InsufficientWalletBalanceException;
use App\Exceptions\WalletNotFoundException;
use App\Models\Wallet;

class WalletServiceImpl implements WalletService
{
    public function createWallet(string $customerId): string
    {
        $wallet = new Wallet();
        $wallet->id = $customerId;
        $wallet->balance = 0;

        $wallet->save();

        return $wallet->id;
    }

    public function getWallet(string $customerId): WalletDto
    {
        $wallet = Wallet::find($customerId);

        if (is_null($wallet)) {

            $wallet = new Wallet();
            $wallet->id = $customerId;
            $wallet->balance = 0;

            $wallet->save();
        }

        return WalletDto::from($wallet);
    }

    public function topUpWallet(string $customerId, TopUpWalletRequest $request): WalletDto
    {
        $wallet = Wallet::where('id', $customerId)->lockForUpdate()->first();

        if (is_null($wallet)) {
            throw new WalletNotFoundException();
        }

        $wallet->balance += $request->amount;

        $wallet->save();

        return WalletDto::from($wallet);
    }

    public function pay(string $customerId, int $amount)
    {
        $wallet = Wallet::where('id', $customerId)->lockForUpdate()->first();

        if (is_null($wallet)) {
            throw new WalletNotFoundException();
        }

        if ($wallet->balance < $amount) {
            throw new InsufficientWalletBalanceException();
        }

        $wallet->balance -= $amount;

        $wallet->save();
    }
}
