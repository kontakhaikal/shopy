<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function __construct(private readonly ProductService $productService)
    {
    }
    public function show()
    {
        return Inertia::render('Home', [
            'products' => $this->productService->getProducts()
        ]);
    }
}
