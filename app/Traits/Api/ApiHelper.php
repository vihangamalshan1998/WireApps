<?php

namespace App\Traits\Api;

use domain\Facades\Chat\ChatFacade;

trait ApiHelper
{
    /**
     * validateHeader
     *
     * @param  mixed $request
     * @param  mixed $headerName
     * @param  mixed $expectedValue
     * @return void
     */
    public function validateHeader($request)
    {
        $apiToken = 'X-Api-Token';
        if ($request->hasHeader($apiToken)) {
            if ($request->header($apiToken) === config('api.api_token')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    /**
     * successResponse
     *
     * @param  mixed $response
     * @param  mixed $responseCode
     * @return void
     */
    public function successResponse($response, $responseCode)
    {
        return response()->json([
            'status' => 'success',
            'data' => $response,
        ], $responseCode)
            ->header('Content-Type', 'application/json');
    }
    /**
     * errorResponse
     *
     * @param  mixed $message
     * @param  mixed $responseCode
     * @return void
     */
    public function errorResponse($message, $responseCode)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $responseCode)
            ->header('Content-Type', 'application/json');
    }
    /**
     * noDataResponse
     *
     * @param  mixed $responseCode
     * @return void
     */
    public function noDataResponse($responseCode)
    {
        return response()->json([
            'status' => 'no-data',
            'message' => 'No data found for the specified criteria.',
            'data' => [],
        ], $responseCode)
            ->header('Content-Type', 'application/json');
    }
    /**
     * validateRequest
     *
     * @param  mixed $request
     * @return void
     */
    public function validateRequest($request)
    {
        if (
            $request->ip() !== null &&
            $request->hasHeader('chat-id') &&
            $request->hasHeader('chat-booking-id') &&
            ChatFacade::validCustomerIpAndChatId($request->ip(), $request->header('chat-id'), $request->header('chat-booking-id'))
        ) {
            return true;
        }
        return false;
    }
    /**
     * validatePermission
     *
     * @param  mixed $request
     * @return void
     */
    public function validatePermission($data)
    {
        $permissions = auth()->user()->roles->flatMap->permissions;
        $permissions = $permissions->pluck('name')->toArray();
        if (in_array($data, $permissions)) {
            return true;
        } else {
            return false;
        }
    }
}
