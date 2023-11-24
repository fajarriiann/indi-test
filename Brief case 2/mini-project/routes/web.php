<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'sale');
Route::resource('customer', CustomerController::class);
Route::resource('item', ItemController::class);
Route::resource('sale', SaleController::class);
Route::post('sale/array', [SaleController::class, 'saleArray'])->name('sale.array');
Route::get('sale/array/{record_id}', [SaleController::class, 'saleArrayDelete'])->name('sale.array.delete');
Route::post('sale/add/item', [SaleController::class, 'saleAddItem'])->name('sale.add.item');
Route::get('sale/delete/item/{id}', [SaleController::class, 'saleDeleteItem'])->name('sale.delete.item');