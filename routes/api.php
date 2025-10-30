<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;


Route::post('/companies', [CompanyController::class, 'store']);
Route::get('/companies/search', [CompanyController::class, 'search']);
