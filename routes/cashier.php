<?php

use App\Http\Controllers\cashier\order\OrderController;
use App\Http\Controllers\cashier\table\TableController;
use App\Http\Controllers\cashier\transaction\TransactionController;
use Illuminate\Support\Facades\Route;


//MOMENTANEO CAJERA
Route::get('/cajera/orders', [OrderController::class, 'index'])->name('cashier.order.index');
Route::get('/cajera/orders/fecth', [OrderController::class, 'fetchOrders'])->name('cashier.order.fetch');


Route::get('/cajera/tables', [TableController::class, 'index'])->name('cashier.table.index');
Route::get('/cajera/tables/fecth', [TableController::class, 'fetchTables'])->name('cashier.table.fetch');

Route::post('/cajera/orders/print/{order}', [OrderController::class, 'print'])->name('cashier.order.print');


Route::get('/cajera/list/order/{order}', [OrderController::class, 'list'])->name('cashier.order.list');
Route::post('/cajera/list/pay/order/{order}', [OrderController::class, 'pay'])->name('cashier.order.pay');


Route::get('/cajera/pays/facturas',[TransactionController::class, 'index'])->name('cashier.pay.index');
Route::get('/cajera/pays/boletas',[TransactionController::class, 'boleta'])->name('cashier.pay.boleta');
Route::get('/cajera/generate/factura/pdf/{pay}',[TransactionController::class, 'pdf'])->name('cashier.pdf');
Route::get('/cajera/generate/boleta/pdf/{pay}',[TransactionController::class, 'pdfBoleta'])->name('cashier.pdf.boleta');