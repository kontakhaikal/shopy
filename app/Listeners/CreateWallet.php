<?php

namespace App\Listeners;

use App\Events\CustomerRegistered;

class CreateWallet
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CustomerRegistered $event): void
    {
        //
    }
}
