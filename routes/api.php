<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\AssignmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::post('login', [AuthController::class, 'login']);
Route::get('subject/get_all_subjects', [SubjectController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('active_user', [AuthController::class, 'activeUser']);
    Route::post('deactive_user', [AuthController::class, 'deactiveUser']);
    Route::get('get_student', [AuthController::class, 'getStudent']);
    Route::get('get_rank', [MarkController::class, 'getRank']);
    Route::resource('subject', SubjectController::class);
    Route::resource('mark', MarkController::class);
    Route::resource('assignment', AssignmentController::class);
});
Route::get('/payment', [StripeController::class, 'checkout']);
Route::post('/session', [StripeController::class, 'session']);
Route::get('/success', [StripeController::class, 'success']);
