<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MasterTicketingController;
use App\Http\Controllers\ProjectHeaderController;
use App\Http\Controllers\ProjectInformationController;
use App\Http\Controllers\ProjectDetailController;
use Illuminate\Support\Facades\Route;

Route::get('/',          fn() => redirect()->route('login'));
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Protected routes — gunakan middleware 'auth' biasa
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users',      UserController::class);
    Route::resource('roles',      RoleController::class);
    Route::resource('ticketing',  MasterTicketingController::class);
    Route::resource('project-header', ProjectHeaderController::class);

    // Nested routes untuk Information & Detail
    Route::resource('project-header.information', ProjectInformationController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('project-header.detail',      ProjectDetailController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);

    // Tambahkan di dalam middleware('auth') group
    Route::get('roles/data',           [RoleController::class,            'dataTable'])->name('roles.data');
    Route::get('users/data',           [UserController::class,            'dataTable'])->name('users.data');
    Route::get('ticketing/data',       [MasterTicketingController::class, 'dataTable'])->name('ticketing.data');
    Route::get('project-header/data',  [ProjectHeaderController::class,   'dataTable'])->name('project-header.data');
});
