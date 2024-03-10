<?php

namespace App\Services;

use App\Dto\ShippingMethodDto;
use App\Dto\ShippingOptionDto;
use App\Models\ShippingOption;
use Illuminate\Support\Facades\File;
use Spatie\LaravelData\DataCollection;

class ShippingServiceImpl implements ShippingService
{
    public function getShippingOptions(): DataCollection
    {
        $shippingOptions = ShippingOption::with('methods')->get();

        return ShippingOptionDto::collect(
            $shippingOptions->map(function (ShippingOption $shippingOption) {
                return new ShippingOptionDto(
                    $shippingOption->id,
                    $shippingOption->name,
                    ShippingMethodDto::collect($shippingOption->methods, DataCollection::class)
                );
            }),
            DataCollection::class
        );
    }
}
