<?php

namespace App\Http\Controllers;

use App\Dto\MakeOrderRequest;
use App\Dto\PrepareOrderRequest;
use App\Services\OrderService;
use App\Services\ShippingService;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class OrderController extends Controller
{
    private $PREPARE_ORDER = "prepare-order";

    public function __construct(
        private readonly OrderService $orderService,
        private readonly WalletService $walletService,
        private readonly ShippingService $shippingService
    ) {
    }

    public function prepare(Request $request, PrepareOrderRequest $body)
    {
        $prepareOrder = $this->orderService->prepareOrder($body);
        $wallet = $this->walletService->getWallet($request->user()->id);
        $shippingOptions = $this->shippingService->getShippingOptions();

        Session::put($this->PREPARE_ORDER, $prepareOrder->items);

        return Inertia::render('Checkout', [
            'items' => $prepareOrder->items,
            'wallet' => $wallet,
            'shippingOptions' => $shippingOptions
        ]);
    }

    public function cachePrepare(Request $request)
    {
        $items = Session::get($this->PREPARE_ORDER);

        if (is_null($items)) {
            return abort(410);
        }

        $wallet = $this->walletService->getWallet($request->user()->id);
        $shippingOptions = $this->shippingService->getShippingOptions();

        return Inertia::render('Checkout', [
            'items' => $items,
            'wallet' => $wallet,
            'shippingOptions' => $shippingOptions
        ]);
    }

    public function createOrder(Request $request, MakeOrderRequest $body)
    {
        $this->orderService->makeOrder($request->user()->id, $body);
    }

    public function show(Request $request)
    {
        $status = $request->query('status');

        if ($status == null || !$this->orderService->checkOrderStatus($status)) {
            return redirect('/orders?status=pack');
        }

        $orders = $this->orderService->getOrderList($request->user()->id, $status);

        return Inertia::render('OrderList', ['orders' => $orders, 'status' => $status]);
    }
}
