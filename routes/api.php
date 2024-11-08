<?php

use App\Http\Controllers\Auth\AuthenticatedApiController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('guest')->group(function () {
    Route::post('login',[AuthenticatedApiController::class,'store'])->name('login');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'edit']);
    Route::resource('companies', CompanyController::class)->except(['create', 'edit']);
    Route::post('companies/{company}/assign-user/{user}', [CompanyController::class, 'assignUser']);
    Route::post('companies/{company}/remove-user/{user}', [CompanyController::class, 'removeUser']);
    Route::resource('projects', ProjectController::class)->except(['create', 'edit']);
});
