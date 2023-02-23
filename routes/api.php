<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SystemController;
use App\Http\Middleware\FitnessFoodsAuth;
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

Route::middleware([
    FitnessFoodsAuth::class
])->group(function () {
    Route::get('/', [SystemController::class, 'info'])->name('system.info');

    Route::apiResource('/products', ProductController::class)
        ->except('store')
        ->names('products');
});
