<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/products/create', [ProductController::class, 'create']); // Mở form
    Route::post('/admin/products/store', [ProductController::class, 'store']); // Bấm nút Lưu
    // Quản lý người dùng
Route::get('/admin/users', [UserController::class, 'index']);
Route::post('/admin/users/{id}/role', [UserController::class, 'updateRole']);
// Quản lý Sản phẩm
Route::get('/admin/products', [ProductController::class, 'index']); // Xem danh sách
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']); // Xóa
Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']); // Mở form sửa
Route::put('/admin/products/{id}', [ProductController::class, 'update']); // Bấm lưu đè
});
