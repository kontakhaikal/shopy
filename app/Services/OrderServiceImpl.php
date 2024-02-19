<?php

namespace App\Services;

use App\Dto\PrepareOrderDto;
use App\Dto\PrepareOrderItemDto;
use App\Dto\PrepareOrderRequest;
use App\Dto\ProductDto;
use App\Exceptions\ProductNotFoundException;
use App\Models\Product;
use Spatie\LaravelData\DataCollection;

class OrderServiceImpl implements OrderService
{
    public function prepareOrder(PrepareOrderRequest $request): PrepareOrderDto
    {
        $items = collect($request->items);

        $productIds = $items->pluck('productId');

        $productMap = $items->keyBy('productId');

        $products = Product::whereIn('id', $productIds)->get();

        if (count($products) !== count($productIds)) {
            throw new ProductNotFoundException();
        }

        return new PrepareOrderDto(
            PrepareOrderItemDto::collect($products->map(function (Product $product) use ($productMap) {
                return new PrepareOrderItemDto(
                    ProductDto::from($product),
                    $productMap[$product->id]['quantity']
                );
            }), DataCollection::class)
        );
    }
}
