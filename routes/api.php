<?php

use App\Http\Controllers\Api\InternetServiceProviderController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\StaffController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('posts', [PostController::class, 'list']);

    Route::post('posts/reaction', [PostController::class, 'toggleReaction']);
    
    Route::post('mpt/invoice-amount', [InternetServiceProviderController::class, 'getMptInvoiceAmount']);
    Route::post('ooredoo/invoice-amount', [InternetServiceProviderController::class, 'getOoredooInvoiceAmount']);
    
    Route::post('job/apply', [JobController::class, 'apply']);
    
    Route::post('staff/salary', [StaffController::class, 'payroll']);
});