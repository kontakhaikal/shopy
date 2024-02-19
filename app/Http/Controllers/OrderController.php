<?php

namespace App\Http\Controllers;

use App\Dto\PrepareOrderRequest;
use App\Services\OrderService;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class OrderController extends Controller
{
    private $PREPARE_ORDER = "prepare-order";

    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function prepare(PrepareOrderRequest $body)
    {
        $prepareOrder = $this->orderService->prepareOrder($body);

        Session::put($this->PREPARE_ORDER, $prepareOrder->items);

        return Inertia::render('Checkout', [
            'items' => $prepareOrder->items
        ]);
    }

    public function cachePrepare()
    {
        $items = Session::get($this->PREPARE_ORDER);

        if (is_null($items)) {
            return abort(410);
        }

        return Inertia::render('Checkout', [
            'items' => $items
        ]);
    }
}
