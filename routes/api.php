<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\md_stockController;
use App\Http\Controllers\md_method_of_paymentController;
use App\Http\Controllers\md_transactionsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/me', [AuthController::class, 'me'])->middleware('auth:api');
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});


Route::prefix('stock')->middleware('auth:api')->group(function () {
    Route::post('/store', [md_stockController::class, 'store']);
    Route::put('/update/{md_stock}', [md_stockController::class, 'update']);
    Route::delete('/{md_stock}', [md_stockController::class, 'destroy']);
});


Route::prefix('payment')->middleware('auth:api')->group(function () {
    Route::post('/store', [md_method_of_paymentController::class, 'store']);
    Route::put('/update/{md_method_of_payment}', [md_method_of_paymentController::class, 'update']);
    Route::delete('/{md_method_of_payment}', [md_method_of_paymentController::class, 'destroy']);
});

Route::prefix('transaction')->middleware('auth:api')->group(function () {
    Route::post('/store', [md_transactionsController::class, 'store']);
    Route::get('/{md_transaction:id_transaction}', [md_transactionsController::class, 'show']);
});
