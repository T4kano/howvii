<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/reports', [ReportController::class, 'loadAll']);
Route::get('/totalsByProperty', [ReportController::class, 'totalsByProperty']);
Route::get('/totalsByMonth', [ReportController::class, 'totalsByMonth']);
Route::get('/typeShare', [ReportController::class, 'typeShare']);
