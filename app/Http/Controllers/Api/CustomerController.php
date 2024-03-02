<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Traits\Api\ApiHelper;
use App\Http\Controllers\Controller;
use Domains\Facades\Customer\CustomerFacade;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    use ApiHelper;
    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            if ($this->validatePermission('CUSTOMER_LIST')) {
                $response = CustomerFacade::all();
                return $this->successResponse($response, Response::HTTP_OK);
            } else {
                return $this->errorResponse('Unauthorized', Response::HTTP_FORBIDDEN);
            }
        } catch (\Exception $e) {
            return $this->errorResponse('An unexpected error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show(Int $id)
    {
        try {
            if ($this->validatePermission('CUSTOMER_VIEW')) {
                $response = CustomerFacade::get($id);
                return $this->successResponse($response, Response::HTTP_OK);
            } else {
                return $this->errorResponse('Unauthorized', Response::HTTP_FORBIDDEN);
            }
        } catch (\Exception $e) {
            return $this->errorResponse('An unexpected error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * create
     *
     * @param  mixed $id
     * @return void
     */
    public function create(Request $request)
    {
        try {
            if ($this->validatePermission('CUSTOMER_CREATE')) {
                $response = CustomerFacade::create($request->all());
                return $this->successResponse($response, Response::HTTP_OK);
            } else {
                return $this->errorResponse('Unauthorized', Response::HTTP_FORBIDDEN);
            }
        } catch (\Exception $e) {
            return $this->errorResponse('An unexpected error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * update
     *
     * @param  mixed $id
     * @return void
     */
    public function update(Int $id, Request $request)
    {
        try {
            if ($this->validatePermission('CUSTOMER_EDIT')) {
                $medication = CustomerFacade::get($id);
                $response = CustomerFacade::update($medication, $request->all());
                return $this->successResponse($response, Response::HTTP_OK);
            } else {
                return $this->errorResponse('Unauthorized', Response::HTTP_FORBIDDEN);
            }
        } catch (\Exception $e) {
            return $this->errorResponse('An unexpected error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy(Int $id, Request $request)
    {
        try {
            if ($this->validatePermission('CUSTOMER_SOFT_DELETE') || $this->validatePermission('CUSTOMER_HARD_DELETE')) {
                $medication = CustomerFacade::get($id);
                if ($this->validatePermission('CUSTOMER_SOFT_DELETE')) {
                    $response = CustomerFacade::delete($medication);
                } else if ($this->validatePermission('CUSTOMER_HARD_DELETE')) {
                    $response = CustomerFacade::full_delete($medication);
                }
                return $this->successResponse($response, Response::HTTP_OK);
            } else {
                return $this->errorResponse('Unauthorized', Response::HTTP_FORBIDDEN);
            }
        } catch (\Exception $e) {
            return $this->errorResponse('An unexpected error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
