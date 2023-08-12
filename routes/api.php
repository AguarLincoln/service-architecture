<?php

use App\Http\Controllers\Auth\Company\CompanyLoginController;
use App\Http\Controllers\Company\CompanyStoreController;
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
        Route::get('/company', function () {
            return 'Hello World';
        });
    });
});

