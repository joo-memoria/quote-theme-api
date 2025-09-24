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
Route::post('/quote', [App\Http\Controllers\Quote\QuoteController::class, 'addQuote']);

Route::group([
    'prefix' => 'content',
    'middleware' => 'auth:sanctum',
], function () {
    // Index (homepage) content
    Route::get('/index', [App\Http\Controllers\ContentIndex\ContentIndexController::class, 'getAllContentIndex']);
    Route::get('/index/{record_id?}', [App\Http\Controllers\ContentIndex\ContentIndexController::class, 'getContentIndex'])->whereNumber('record_id');
    Route::post('/index', [App\Http\Controllers\ContentIndex\ContentIndexController::class, 'addContentIndex']);
    Route::patch('/index/{record_id}', [App\Http\Controllers\ContentIndex\ContentIndexController::class, 'updateContentIndex']);
    Route::delete('/index/{record_id}', [App\Http\Controllers\ContentIndex\ContentIndexController::class, 'softDeleteContentIndex']);

    // About content
    Route::get('/about', [App\Http\Controllers\ContentAbout\ContentAboutController::class, 'getAllContentAbout']);
    Route::get('/about/{record_id?}', [App\Http\Controllers\ContentAbout\ContentAboutController::class, 'getContentAbout'])->whereNumber('record_id');
    Route::post('/about', [App\Http\Controllers\ContentAbout\ContentAboutController::class, 'addContentAbout']);
    Route::patch('/about/{record_id}', [App\Http\Controllers\ContentAbout\ContentAboutController::class, 'updateContentAbout']);
    Route::delete('/about/{record_id}', [App\Http\Controllers\ContentAbout\ContentAboutController::class, 'softDeleteContentAbout']);

    // How It Works content
    Route::get('/how-it-works', [App\Http\Controllers\ContentHowItWorks\ContentHowItWorksController::class, 'getAllContentHowItWorks']);
    Route::get('/how-it-works/{record_id?}', [App\Http\Controllers\ContentHowItWorks\ContentHowItWorksController::class, 'getContentHowItWorks'])->whereNumber('record_id');
    Route::post('/how-it-works', [App\Http\Controllers\ContentHowItWorks\ContentHowItWorksController::class, 'addContentHowItWorks']);
    Route::patch('/how-it-works/{record_id}', [App\Http\Controllers\ContentHowItWorks\ContentHowItWorksController::class, 'updateContentHowItWorks']);
    Route::delete('/how-it-works/{record_id}', [App\Http\Controllers\ContentHowItWorks\ContentHowItWorksController::class, 'softDeleteContentHowItWorks']);
});

// Public latest content endpoints
Route::get('/content/index/latest', [App\Http\Controllers\ContentIndex\ContentIndexController::class, 'getLatestPublished']);
Route::get('/content/about/latest', [App\Http\Controllers\ContentAbout\ContentAboutController::class, 'getLatestPublished']);
Route::get('/content/how-it-works/latest', [App\Http\Controllers\ContentHowItWorks\ContentHowItWorksController::class, 'getLatestPublished']);

