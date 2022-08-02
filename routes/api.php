<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
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

Route::group(['prefix' => '/product'], function(){

    Route::get('/', [ProductController::class, 'index']);
    Route::post('/', [ProductController::class, 'store']);
    Route::get('/{product}/', [ProductController::class, 'show']);
    Route::put('/{product}/', [ProductController::class, 'update']);
    Route::delete('/{product}/', [ProductController::class, 'destroy']);

    Route::get('/{product}/variant/{productVariant}/', [ProductVariantController::class, 'show']);
    Route::post('/{product}/variant/', [ProductVariantController::class, 'store']);
    Route::delete('/{product}/variant/{productVariant}/', [ProductVariantController::class, 'destroy']);
    Route::put('/{product}/variant/{productVariant}/', [ProductVariantController::class, 'update']);
});


