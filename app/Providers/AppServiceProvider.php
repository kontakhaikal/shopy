<?php

namespace App\Providers;

use App\Services\CartService;
use App\Services\CartServiceImpl;
use App\Services\CustomerService;
use App\Services\CustomerServiceImpl;
use App\Services\OrderService;
use App\Services\OrderServiceImpl;
use App\Services\PaymentService;
use App\Services\PaymentServiceImpl;
use App\Services\ProductService;
use App\Services\ProductServiceImpl;
use App\Services\ShippingService;
use App\Services\ShippingServiceImpl;
use App\Services\WalletService;
use App\Services\WalletServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        collect([
            CustomerService::class => CustomerServiceImpl::class,
            ProductService::class => ProductServiceImpl::class,
            CartService::class => CartServiceImpl::class,
            OrderService::class => OrderServiceImpl::class,
            WalletService::class => WalletServiceImpl::class,
            ShippingService::class => ShippingServiceImpl::class,
            PaymentService::class  => PaymentServiceImpl::class,
        ])->each(fn ($concrete, $abstract) => $this->app->bind($abstract, $concrete, true));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
