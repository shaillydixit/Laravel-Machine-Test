<?php

use App\Http\Controllers\Api\CompanyApiController;
use App\Http\Controllers\Api\EmployeeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Company Routes
Route::get('/company-details/{id}', [CompanyApiController::class, 'companyDetails']);
Route::post('/company-add', [CompanyApiController::class, 'companyAdd']);
Route::get('/company/{id}/employees', [EmployeeApiController::class, 'getEmployeesByCompany']);
Route::post('/employee-add', [EmployeeApiController::class, 'employeeAdd']);
