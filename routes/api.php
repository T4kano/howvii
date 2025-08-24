<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/reports', [ReportController::class, 'loadAll']);
