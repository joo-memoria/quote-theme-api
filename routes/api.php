<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::group([
    "prefix"        => "auth",
    "middleware"    => "auth:sanctum"
], function(){
    Route::group([
        "prefix"    => "user"
    ], function(){
        Route::get('/{record_id}', [App\Http\Controllers\User\UserController::class, 'getUser']);
        Route::get('/', [App\Http\Controllers\User\UserController::class, 'getUser']);
        Route::post('/', [App\Http\Controllers\User\UserController::class, 'addUser']);
        Route::patch('/{record_id}', [App\Http\Controllers\User\UserController::class, 'updateUser']);
        Route::delete('/{record_id}', [App\Http\Controllers\User\UserController::class, 'softDeleteUser']);
    });
    Route::get('/me', [AuthController::class, 'me']);
    // me endpoint inside auth group

});

Route::group([
    'prefix' => 'quote',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [App\Http\Controllers\Quote\QuoteController::class, 'getAllQuotes']);
    Route::get('/{record_id?}', [App\Http\Controllers\Quote\QuoteController::class, 'getQuote']);
    Route::patch('/{record_id}', [App\Http\Controllers\Quote\QuoteController::class, 'updateQuote']);
    Route::delete('/{record_id}', [App\Http\Controllers\Quote\QuoteController::class, 'softDeleteQuote']);
});

// Auth endpoints
Route::post('/auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'logout']);

// Public create bus-quote
Route::post('/bus-quote', [App\Http\Controllers\Quote\QuoteController::class, 'addQuote']);

