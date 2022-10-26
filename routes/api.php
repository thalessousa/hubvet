<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
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

Route::group(
    [
        'middleware' => ['auth:sanctum'],
    ],
    function () {
        Route::apiResource('products', 'ProductController');
        Route::apiResource('sectors', 'SectorController');
        Route::apiResource('stores', 'StoreController');
        Route::apiResource('users', 'UserController')->except(['update']);
        Route::prefix('users')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('', 'login');
                Route::get('', 'login');
                Route::delete('{user}', 'destroy');
            });
        });
    }
);
