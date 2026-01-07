<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('/products/import', [ProductController::class, 'import']);
Route::post('/uploads/chunk', [UploadController::class, 'upload']);
Route::post('/uploads/complete', [UploadController::class, 'complete']);


