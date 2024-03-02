<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Domains\Facades\User\UserFacade;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request)
    {
        return UserFacade::loginApi($request);
    }
    /**
     * logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        return UserFacade::logOutApi($request);
    }
}
