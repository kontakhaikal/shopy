<?php

namespace App\Services;

use App\Dto\AddCartItemRequest;
use App\Dto\CartDto;
use App\Dto\CartItemDto;
use App\Dto\ProductDto;
use App\Exceptions\CartNotFoundException;
use App\Exceptions\ProductNotFoundException;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Spatie\LaravelData\DataCollection;

class CartServiceImpl implements CartService
{
    public function createCart(string $customerId): string
    {
        $cart = new Cart();
        $cart->customer_id = $customerId;

        $cart->save();

        return $cart->id;
    }

    public function getCart(string $customerId): CartDto
    {
        $cart = Cart::where('customer_id', $customerId)->first();

        if (is_null($cart)) {
            throw new CartNotFoundException();
        }

        return new CartDto(
            $cart->id,
            CartItemDto::collect(
                $cart->items->map(
                    fn (CartItem $item) => new CartItemDto(
                        $item->id,
                        ProductDto::from($item->product),
                        $item->quantity,
                        $item->selected
                    )
                ),
                DataCollection::class
            )
        );
    }

    public function addItem(string $customerId, AddCartItemRequest $request): string
    {
        $cart = Cart::where('customer_id', $customerId)->first();

        if (is_null($cart)) {
            throw new CartNotFoundException();
        }

        $product = Product::where('id', $request->productId)->first();

        if (is_null($product)) {
            throw new ProductNotFoundException();
        }

        $item = new CartItem();

        $item->product_id = $product->id;
        $item->selected = true;
        $item->quantity = $product->stock > 0 ? 1 : 0;

        $cart->items()->save($item);

        return $item->id;
    }
}
