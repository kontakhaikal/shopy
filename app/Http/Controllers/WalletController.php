<?php

namespace App\Http\Controllers;

use App\Dto\TopUpWalletRequest;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WalletController extends Controller
{
    public function __construct(private readonly WalletService $walletService)
    {
    }

    public function show(Request $request)
    {
        $wallet = $this->walletService->getWallet($request->user()->id);

        return Inertia::render('Wallet', [
            'wallet' => $wallet
        ]);
    }

    public function topUp(Request $request, TopUpWalletRequest $body)
    {
        $this->walletService->topUpWallet($request->user()->id, $body);
        return to_route('wallet');
    }
}
