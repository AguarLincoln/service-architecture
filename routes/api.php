<?php

use App\Http\Controllers\Auth\Company\CompanyLoginController;
use App\Http\Controllers\Category\CategoryShowController;
use App\Http\Controllers\Category\CategoryStoreController;
use App\Http\Controllers\Company\CompanyStoreController;
use App\Http\Controllers\Product\ProductStoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Group middleware company

Route::group([
    'prefix' => 'company'
], function () {
    //middleware without auth:api-company
    Route::post('/', CompanyStoreController::class);


    //middleware auth:api-company
    Route::group(['middleware' => 'auth:api-company'], function () {
        
    });
});

// Group middleware category

Route::group([
    'prefix' => 'category'
], function () {

    //middleware auth:api-category
    Route::group(['middleware' => 'auth:api-company'], function () {
        Route::post('/', CategoryStoreController::class);
        Route::get('/', CategoryShowController::class);
    });
});


// Product
Route::group([
    'prefix' => 'product'
], function () {

    //middleware auth:api-category
    Route::group(['middleware' => 'auth:api-company'], function () {
        Route::post('/{category}', ProductStoreController::class);
        Route::get('/', CategoryShowController::class);
    });
});
