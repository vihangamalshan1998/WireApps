<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Api\ApiHelper;
use Domains\Facades\Medication\MedicationFacade;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedicationController extends Controller
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
            if ($this->validatePermission('MEDICATION_LIST')) {
                $response = MedicationFacade::all();
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
            if ($this->validatePermission('MEDICATION_VIEW')) {
                $response = MedicationFacade::get($id);
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
            if ($this->validatePermission('MEDICATION_CREATE')) {
                $response = MedicationFacade::create($request->all());
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
            if ($this->validatePermission('MEDICATION_EDIT')) {
                $medication = MedicationFacade::get($id);
                $response = MedicationFacade::update($medication, $request->all());
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
            if ($this->validatePermission('MEDICATION_SOFT_DELETE') || $this->validatePermission('MEDICATION_HARD_DELETE')) {
                $medication = MedicationFacade::get($id);
                if ($this->validatePermission('MEDICATION_SOFT_DELETE')) {
                    $response = MedicationFacade::delete($medication);
                } else if ($this->validatePermission('MEDICATION_HARD_DELETE')) {
                    $response = MedicationFacade::full_delete($medication);
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
