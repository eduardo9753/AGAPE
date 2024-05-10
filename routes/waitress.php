<?php

use App\Http\Controllers\waitress\order\OrderController;
use App\Http\Controllers\waitress\table\TableController;
use Illuminate\Support\Facades\Route;

//RUTAS PARA LA MESERA
Route::get('/waitress/orders/list', [OrderController::class , 'list'])->name('waitress.order.list');
Route::get('/waitress/orders/fecth', [OrderController::class, 'fetchOrders'])->name('cashier.order.fetch');

Route::post('/waitress/orders/table/update', [OrderController::class, 'update'])->name('waitress.table.update');

Route::get('/waitress/tables', [TableController::class, 'index'])->name('waitress.table.index');
Route::get('/waitress/tables/fecth', [TableController::class, 'fetchTables'])->name('waitress.table.fetch');

Route::post('/waitress/orders/table/change', [OrderController::class, 'tableChange'])->name('waitress.order.table.change');

Route::get('/waitress/orders/show/{order}', [OrderController::class, 'show'])->name('waitress.order.show');
Route::delete('/waitress/order/delete/{order}', [OrderController::class , 'delete'])->name('waitress.order.delete');
Route::get('/waitress/orders/{table}', [OrderController::class, 'index'])->name('waitress.order.index');