<?php

namespace Domains\Facades\User;

use Domains\Services\User\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * User Facade
 * @category Facade
 * */

class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserService::class;
    }
}
