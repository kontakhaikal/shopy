<?php

namespace App\Http\Controllers;

use App\Dto\RegisterCustomerRequest;
use App\Services\CustomerService;
use Inertia\Inertia;

class CustomerController extends Controller
{

    public function __construct(
        private readonly CustomerService $customerService
    ) {
    }

    public function create()
    {
        return Inertia::render('Register');
    }

    public function store(RegisterCustomerRequest $body)
    {
        $this->customerService->register($body);
        return to_route('login');
    }
}
