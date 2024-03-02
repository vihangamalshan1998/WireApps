<?php

namespace Domains\Facades\Customer;

use Domains\Services\Customer\CustomerService;
use Illuminate\Support\Facades\Facade;

/**
 * Customer Facade
 * @category Facade
 * */

class CustomerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomerService::class;
    }
}
