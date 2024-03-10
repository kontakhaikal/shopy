<?php

namespace Tests\Unit;

use App\Services\OrderServiceImpl;
use Tests\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class OrderServiceImplTest extends TestCase
{
    function testCheckOrderStatusExist()
    {
        /** @var OrderServiceImpl */
        $order =  $this->app->get(OrderServiceImpl::class);
        $result =  $order->checkOrderStatus("paid");
        assertTrue($result);
    }

    function testCheckOrderStatusAbcent()
    {
        /** @var OrderServiceImpl */
        $order =  $this->app->get(OrderServiceImpl::class);
        $result =  $order->checkOrderStatus("not paid");
        assertFalse($result);
    }
}
