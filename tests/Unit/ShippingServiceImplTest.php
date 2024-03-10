<?php

namespace Tests\Unit;

use App\Services\ShippingServiceImpl;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class ShippingServiceImplTest extends TestCase
{


    public function testGetShippingOptions()
    {
        $service = new ShippingServiceImpl();

        $options =  $service->getShippingOptions();

        assertEquals(34, $options->count());
    }
}
