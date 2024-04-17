<?php

use App\Http\Controllers\waitress\order\OrderController;
use App\Http\Controllers\waitress\table\TableController;
use Illuminate\Support\Facades\Route;

//RUTAS PARA LA MESERA
Route::get('/waitress/orders', [OrderController::class, 'index'])->name('waitress.order.index');

Route::get('/waitress/orders/list', [OrderController::class , 'list'])->name('waitress.order.list');
Route::get('/waitress/orders/fecth', [OrderController::class, 'fetchOrders'])->name('cashier.order.fetch');

Route::post('/waitress/orders/print/{order}', [OrderController::class, 'print'])->name('waitress.order.print');

Route::get('/waitress/tables', [TableController::class, 'index'])->name('waitress.table.index');
Route::get('/waitress/tables/fecth', [TableController::class, 'fetchTables'])->name('waitress.table.fetch');


Route::get('/waitress/orders/show/{order}', [OrderController::class, 'show'])->name('cashier.order.show');
Route::delete('/waitress/order/delete/{order}', [OrderController::class , 'delete'])->name('cashier.order.delete');
