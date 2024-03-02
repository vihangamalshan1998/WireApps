<?php

namespace Domains\Services\User;

use App\Domains\Auth\Models\User;
use App\Traits\Api\ApiHelper;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * UserService
 *
 * */
class UserService
{
    use ApiHelper;
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Get all user
     *
     * @return Collection
     */
    public function all(): ?Collection
    {
        return $this->user->all();
    }
    /**
     * Get customer By Id
     *
     * @param  int $customer_id
     * @return User
     */
    public function get(int $id): ?User
    {
        return $this->user->find($id);
    }
    /**
     * loginApi
     *
     * @param  mixed $request
     * @return void
     */
    function loginApi(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if (Auth::attempt($request->only('email', 'password'))) {
                // Attempt authentication
                $user = $this->get(Auth::user()->id);

                if ($user) {
                    // If user exists
                    try {
                        $token = $user->createToken('AppToken')->accessToken;
                        // Create token
                        $response['access_token'] = $token;
                        $response['user'] = $user;
                        $response['role'] = $user->roles[0]->name;
                        $response['permission_list'] = $user->roles[0]->permissions;
                        return $this->successResponse($response, Response::HTTP_OK);
                    } catch (\Exception $e) {
                        // Handle token creation error
                        return $this->errorResponse('Token creation error: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
                    }
                } else {
                    // If user doesn't exist
                    return $this->noDataResponse(Response::HTTP_OK);
                }
            } else {
                // If authentication fails
                return $this->errorResponse('Invalid credentials', Response::HTTP_UNAUTHORIZED);
            }
        } catch (Exception $e) {
            return $this->errorResponse('An unexpected error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
