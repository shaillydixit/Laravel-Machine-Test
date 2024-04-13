<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware('auth')->group(function () {

Route::get('/dashboard',[AdminController::class, 'AdminDashboard'])->name('dashboard');
Route::get('/admin/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout');

});
require __DIR__.'/auth.php';
