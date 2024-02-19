<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\CartServiceImpl;
use App\Services\CustomerService;
use App\Services\CustomerServiceImpl;
use App\Services\OrderService;
use App\Services\OrderServiceImpl;
use App\Services\ProductService;
use App\Services\ProductServiceImpl;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CustomerService::class, CustomerServiceImpl::class, true);
        $this->app->bind(ProductService::class, ProductServiceImpl::class, true);
        $this->app->bind(CartService::class, CartServiceImpl::class, true);
        $this->app->bind(OrderService::class, OrderServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
