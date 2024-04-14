<?php

use App\Http\Controllers\cashier\order\OrderController;
use App\Http\Controllers\cashier\transaction\TransactionController;
use Illuminate\Support\Facades\Route;


//MOMENTANEO CAJERA
Route::get('/cajera/orders', [OrderController::class, 'index'])->name('cashier.order.index');
Route::get('/cajera/orders/fecth', [OrderController::class, 'fetchOrders'])->name('cashier.order.fetch');


Route::get('/cajera/list/order/{order}', [OrderController::class, 'list'])->name('cashier.order.list');
Route::post('/cajera/list/pay/order/{order}', [OrderController::class, 'pay'])->name('cashier.pay.list');


Route::get('/cajera/pays',[TransactionController::class, 'index'])->name('cashier.pay.index');
Route::get('/cajera/generate/pdf/{pay}',[TransactionController::class, 'pdf'])->name('cashier.pdf');