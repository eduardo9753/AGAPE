<?php

use App\Http\Controllers\waitress\order\OrderController;
use Illuminate\Support\Facades\Route;

//RUTAS PARA LA MESERA
Route::get('/waitress/orders', [OrderController::class, 'index'])->name('waitress.order.index');

Route::get('/waitress/orders/list', [OrderController::class , 'list'])->name('waitress.order.list');
Route::get('/waitress/orders/fecth', [OrderController::class, 'fetchOrders'])->name('cashier.order.fetch');


Route::get('/waitress/orders/show/{order}', [OrderController::class, 'show'])->name('cashier.order.show');
Route::delete('/waitress/order/delete/{order}', [OrderController::class , 'delete'])->name('cashier.order.delete');
