<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Development-only: preview mailable in browser
Route::get('/dev/mail/bus-quote', [\App\Http\Controllers\Dev\MailPreviewController::class, 'quote']);
    