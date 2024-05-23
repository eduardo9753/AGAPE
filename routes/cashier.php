<?php

use App\Http\Controllers\cashier\order\OrderController;
use App\Http\Controllers\cashier\table\TableController;
use App\Http\Controllers\cashier\transaction\TransactionController;
use App\Http\Controllers\delivery\DeliberyController;
use Illuminate\Support\Facades\Route;


//MOMENTANEO CAJERA
Route::get('/cajera/orders', [OrderController::class, 'index'])->name('cashier.order.index');
Route::get('/cajera/orders/fecth', [OrderController::class, 'fetchOrders'])->name('cashier.order.fetch');


Route::get('/cajera/tables', [TableController::class, 'index'])->name('cashier.table.index');
Route::get('/cajera/tables/liberar/{table}', [TableController::class, 'liberarMesa'])->name('cashier.table.liberar');
Route::get('/cajera/tables/fecth', [TableController::class, 'fetchTables'])->name('cashier.table.fetch');

//Route::post('/cajera/orders/print/{order}', [OrderController::class, 'print'])->name('cashier.order.print');
Route::post('/cajera/orders/table/update', [OrderController::class, 'update'])->name('cashier.table.update');

Route::get('/cajera/list/order/{order}', [OrderController::class, 'list'])->name('cashier.order.list');
Route::post('/cajera/list/pay/order/{order}', [OrderController::class, 'pay'])->name('cashier.order.pay');


Route::get('/cajera/pays/facturas',[TransactionController::class, 'index'])->name('cashier.pay.index');
Route::get('/cajera/pays/boletas',[TransactionController::class, 'boleta'])->name('cashier.pay.boleta');
Route::get('/cajera/generate/factura/pdf/{pay}',[TransactionController::class, 'pdf'])->name('cashier.pdf');
Route::get('/cajera/generate/boleta/pdf/{pay}',[TransactionController::class, 'pdfBoleta'])->name('cashier.pdf.boleta');


//ruta para el delibery de la cajera
Route::get('/cajera/delivery', [DeliberyController::class ,'deliberyCashier'])->name('cashier.delibery.index');
Route::get('/cajera/orders/delivery', [DeliberyController::class, 'orderdeliberyCashier'])->name('cashier.delibery.order');
Route::get('/cajera/orders/delivery/fecth', [DeliberyController::class, 'fetchOrdersDelivery'])->name('cashier.order.delivery.fetch');
Route::delete('/cajera/order/delete/{order}', [DeliberyController::class , 'delete'])->name('cashier.order.delete');