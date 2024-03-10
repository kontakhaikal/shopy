<?php

namespace App\Http\Controllers;

use App\Dto\AddCartItemRequest;
use App\Services\CartService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService
    ) {
    }

    public function show(Request $request)
    {
        return Inertia::render('Cart', [
            'cart' => $this->cartService->getCart($request->user()->id)
        ]);
    }

    public function storeItem(Request $request, AddCartItemRequest $body)
    {
        $this->cartService->addItem($request->user()->id, $body);
        return to_route('cart');
    }
}
