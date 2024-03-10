<?php

namespace App\Services;

use App\Dto\MakeOrderRequest;
use App\Dto\OrderDto;
use App\Dto\PrepareOrderDto;
use App\Dto\PrepareOrderRequest;
use Spatie\LaravelData\DataCollection;

interface OrderService
{
    public function prepareOrder(PrepareOrderRequest $request): PrepareOrderDto;
    public function makeOrder(string $customerId, MakeOrderRequest $request): string;
    /**
     * @return DataCollection<OrderDto>
     */
    public function getOrderList(string $customerId, string $status): DataCollection;

    public function checkOrderStatus(string $status): bool;
}
