<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;
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

Route::apiResource('customer', CustomerController::class)->only(['index', 'store', 'update', 'destroy']);
Route::apiResource('item', ItemController::class)->only(['index', 'store', 'update', 'destroy']);
Route::apiResource('sale', SaleController::class)->only(['index', 'store', 'update', 'destroy']);