<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
Route::get('/', [ShopController::class, 'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/products/create', [ProductController::class, 'create']); // Mở form
    Route::post('/admin/products/store', [ProductController::class, 'store']); // Bấm nút Lưu
        // Quản lý Banner
    Route::get('/admin/banners', [BannerController::class, 'index'])->name('admin.banners.index');
    Route::get('/admin/banners/create', [BannerController::class, 'create'])->name('admin.banners.create');
    Route::post('/admin/banners/store', [BannerController::class, 'store'])->name('admin.banners.store');
    Route::get('/admin/banners/{banner}/edit', [BannerController::class, 'edit'])->name('admin.banners.edit');
    Route::put('/admin/banners/{banner}', [BannerController::class, 'update'])->name('admin.banners.update');
    Route::delete('/admin/banners/{banner}', [BannerController::class, 'destroy'])->name('admin.banners.destroy');
    // Quản lý người dùng
Route::get('/admin/users', [UserController::class, 'index']);
Route::post('/admin/users/{id}/role', [UserController::class, 'updateRole']);
// Quản lý Sản phẩm
Route::get('/admin/products', [ProductController::class, 'index']); // Xem danh sách
Route::delete('/admin/products/{id}', [ProductController::class, 'destroy']); // Xóa
Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit']); // Mở form sửa
Route::put('/admin/products/{id}', [ProductController::class, 'update']); // Bấm lưu đè
// Quản lý Đơn hàng
    Route::get('/admin/orders', [OrderController::class, 'index']); // Xem danh sách
    Route::put('/admin/orders/{id}/status', [OrderController::class, 'updateStatus']); // Đổi trạng thái
    // Chỉnh sửa hồ sơ cá nhân
    Route::get('/profile/edit', [ProfileController::class, 'edit']); // Mở form
    Route::put('/profile/update', [ProfileController::class, 'update']); // Bấm lưu đè
    // Quản lý Danh mục
    Route::get('/admin/categories', [\App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('/admin/categories', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::delete('/admin/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy']);
});
// Đường dẫn thêm sản phẩm vào giỏ hàng
Route::get('/cart/add/{id}', [CartController::class, 'add']);
// Xem chi tiết Giỏ hàng
Route::get('/cart', [CartController::class, 'index']);
// Trang thông tin cá nhân của khách hàng
    Route::get('/profile', [ProfileController::class, 'index']);
    // Cập nhật và Xóa sản phẩm trong giỏ
Route::patch('/cart/update', [CartController::class, 'update']);
Route::delete('/cart/remove', [CartController::class, 'remove']);
// Trang Thanh Toán (Checkout)
Route::get('/checkout', [CheckoutController::class, 'index']);
