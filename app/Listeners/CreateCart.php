<?php

namespace App\Listeners;

use App\Events\CustomerRegistered;
use App\Services\CartService;

class CreateCart
{
    /**
     * Create the event listener.
     */
    public function __construct(private readonly CartService $cartService)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(CustomerRegistered $event): void
    {
        $this->cartService->createCart($event->customer->id);
    }
}
