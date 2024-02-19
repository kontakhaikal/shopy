<?php

namespace App\Services;

use Spatie\LaravelData\DataCollection;

interface ProductService
{
    function getProducts(): DataCollection;
}
