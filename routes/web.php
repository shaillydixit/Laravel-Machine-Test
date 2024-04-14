<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware('auth')->group(function () {

Route::get('/dashboard',[AdminController::class, 'AdminDashboard'])->name('dashboard');
Route::get('/admin/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
Route::get('/companies/show', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');

});
require __DIR__.'/auth.php';
