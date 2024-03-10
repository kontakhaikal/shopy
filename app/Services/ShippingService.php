<?php

namespace App\Services;

use Spatie\LaravelData\DataCollection;

interface ShippingService
{
    public function getShippingOptions(): DataCollection;
}
