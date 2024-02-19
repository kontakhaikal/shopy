<?php

namespace App\Services;

use App\Dto\ProductDto;
use App\Models\Product;
use Spatie\LaravelData\DataCollection;

class ProductServiceImpl implements ProductService
{
    public function getProducts(): DataCollection
    {
        $products = Product::all();
        return ProductDto::collect($products, DataCollection::class);
    }
}
