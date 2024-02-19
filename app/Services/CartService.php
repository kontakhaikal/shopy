<?php

namespace App\Services;

use App\Dto\AddCartItemRequest;
use App\Dto\CartDto;

interface CartService
{
    public function getCart(string $customerId): CartDto;
    public function createCart(string $customerId): string;
    public function addItem(string $customerId, AddCartItemRequest $request): string;
}
