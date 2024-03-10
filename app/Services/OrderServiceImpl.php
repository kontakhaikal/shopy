<?php

namespace App\Services;

use App\Dto\CreatePaymentRequest;
use App\Dto\MakeOrderRequest;
use App\Dto\OrderDto;
use App\Dto\OrderItemDto;
use App\Dto\OrderItemRequest;
use App\Dto\PaymentMethod;
use App\Dto\PaymentStatus;
use App\Dto\PrepareOrderDto;
use App\Dto\PrepareOrderItemDto;
use App\Dto\PrepareOrderRequest;
use App\Dto\ProductDto;
use App\Dto\ShippingDto;
use App\Dto\ShippingMethodDto;
use App\Exceptions\ProductNotFoundException;
use App\Exceptions\ShippingMethodNotFoundException;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\ShippingMethod;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\DataCollection;

class OrderServiceImpl implements OrderService
{
    public function __construct(
        private readonly PaymentService $paymentService
    ) {
    }

    public function checkOrderStatus(string $status): bool
    {
        return OrderStatus::tryFrom($status) !== null;
    }

    public function getOrderList(string $customerId, string $status): DataCollection
    {
        $orders = Order::where([
            ['customer_id', $customerId], ['status', $status]
        ])->get();

        return OrderDto::collect(
            $orders->map(
                function (Order $order) {
                    return new OrderDto(
                        $order->id,
                        OrderItemDto::collect($order->items->map(function (OrderItem $item) {
                            return new OrderItemDto(
                                $item->id,
                                new ProductDto(
                                    $item->product->id,
                                    $item->product->name,
                                    $item->product->price,
                                    $item->product->stock,
                                    $item->product->picture
                                ),
                                $item->quantity,
                                $item->price
                            );
                        }), DataCollection::class),
                        OrderStatus::from($order->status),
                        new ShippingDto(
                            ShippingMethodDto::from($order->shipping->method)
                        )

                    );
                }
            ),
            DataCollection::class
        );
    }

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

    public function makeOrder(string $customerId, MakeOrderRequest $request): string
    {
        $order = new Order();

        DB::transaction(function () use ($request, $customerId, $order) {
            $order->setStatus(OrderStatus::PLACED);
            $order->customer_id = $customerId;
            $order->save();

            $items = collect($request->items->all());

            $products = Product::whereIn('id', $items->pluck('productId'))->get();

            if (count($products) !== count($items)) {
                throw new ProductNotFoundException();
            }

            $shippingMethod = ShippingMethod::find($request->shippingMethodId);

            if (is_null($shippingMethod)) {
                throw new ShippingMethodNotFoundException();
            }

            $shipping = new Shipping();
            $shipping->setShippingMethod($shippingMethod);
            $shipping->setOrder($order);

            $shipping->save();

            $productMap = $products->keyBy('id');

            $items->each(function (OrderItemRequest $item) use ($order, $productMap) {

                $product = $productMap[$item->productId];

                $orderItem = new OrderItem();
                $orderItem->setProduct($product);
                $orderItem->setPrice($product->price);
                $orderItem->setQuantity($item->quantity);
                $orderItem->setOrder($order);
                $orderItem->save();

                $product->reduceStock($item->quantity);
                $product->save();
            });

            $totalPrice = $order->calculateTotalPrice();

            $payment = $this->paymentService->createPayment(
                $customerId,
                new CreatePaymentRequest(
                    $totalPrice,
                    PaymentMethod::tryFrom($request->paymentMethod)
                )
            );

            switch ($payment->status) {
                case PaymentStatus::PAID:
                    $order->setStatus(OrderStatus::PAID);
                    break;
                case PaymentStatus::CHARGED;
                    $order->setStatus(OrderStatus::PENDING);
                    break;
            }

            $order->save();
        });

        return $order->id;
    }
}
