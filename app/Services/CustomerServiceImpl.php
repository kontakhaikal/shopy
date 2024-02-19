<?php

namespace App\Services;

use App\Dto\RegisterCustomerRequest;
use App\Events\CustomerRegistered;
use App\Models\Customer;

class CustomerServiceImpl implements CustomerService
{

    function register(RegisterCustomerRequest $request): string
    {
        $customer = new Customer();

        $customer->username = $request->username;
        $customer->password = $request->password;

        $customer->save();

        CustomerRegistered::dispatch($customer);

        return $customer->id;
    }
}
