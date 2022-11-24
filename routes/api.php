<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PosController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bundle-products/{id}', 'BundleApiController@bundleById');
Route::get('get/order/status/{id}',[OrderController::class, 'getOrderStatus']);

Route::get('get/category/products/{id}',[PosController::class, 'getCategorizedProducts']);

// Route::post('/patients', 'SMS\PatientController@store');
