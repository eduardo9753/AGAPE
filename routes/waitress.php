<?php

use App\Http\Controllers\waitress\order\OrderController;
use Illuminate\Support\Facades\Route;

//RUTAS PARA LA MESERA
Route::get('/waitress/orders', [OrderController::class, 'index'])->name('waitress.order.index');