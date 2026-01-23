<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Owner\DashboardOwnerController;

Route::get('/', [HomeController::class, 'homePage'])->name('home');
Route::get('/about', [AboutController::class, 'aboutPage'])->name('about');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.proses');

    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.proses');
});

Route::middleware('auth')->group(function () {
    Route::middleware('role::pelanggan')->group(function () {});

    Route::prefix('admin')->middleware('role:admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'dashboardPage'])->name('dashboard');

        Route::get('/kategory', [CategoryController::class, 'index'])->name('category');
        Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/category/{category}/delete', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::resource('products', ProductController::class);
    });

    Route::prefix('owner')->middleware('role:owner')->name('owner.')->group(function () {
        Route::get('/dashboard', [DashboardOwnerController::class, 'dashboardPage'])->name('dashboard');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
