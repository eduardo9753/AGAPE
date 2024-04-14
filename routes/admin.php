<?php

use App\Http\Controllers\admin\category\CategoryController;
use App\Http\Controllers\admin\dashboard\DashboardController;
use App\Http\Controllers\admin\dish\DishController;
use App\Http\Controllers\admin\role\RoleController;
use App\Http\Controllers\admin\table\TableController;
use App\Http\Controllers\admin\user\UserController;
use Illuminate\Support\Facades\Route;

//RUTAS DEL ADMINISTRADOR CON LIVEWIRE
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::get('/admin/dish/create', [DishController::class, 'index'])->name('admin.dish.index');

Route::get('/admin/categiry/create', [CategoryController::class, 'index'])->name('admin.category.index');

Route::get('/admin/table/create', [TableController::class, 'index'])->name('admin.table.index');



/**RUTA PARA LOS ROLES Y PERMISOS */
Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.roles.index');
Route::get('/admin/role/create', [RoleController::class, 'create'])->name('admin.roles.create');
Route::post('/admin/role/store', [RoleController::class, 'store'])->name('admin.roles.store');
Route::put('/admin/role/update/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
Route::get('/admin/role/edit/{role}', [RoleController::class, 'edit'])->name('admin.roles.edit');
Route::delete('/admin/role/destroy/{role}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');



Route::get('/admin/user', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/admin/user/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/admin/user/store', [UserController::class, 'store'])->name('admin.users.store');
Route::put('/admin/user/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::get('/admin/user/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');