<?php

namespace App\Services;

use App\Dto\PrepareOrderDto;
use App\Dto\PrepareOrderRequest;

interface OrderService
{
    public function prepareOrder(PrepareOrderRequest $request): PrepareOrderDto;
}
