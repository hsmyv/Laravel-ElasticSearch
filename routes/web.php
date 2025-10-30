<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('api/companies', [CompanyController::class, 'store']);
Route::get('api/companies/search', [CompanyController::class, 'search']);
