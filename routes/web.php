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

// Public
Route::get('/',          fn() => redirect()->route('login'));
Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Protected
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ⚠️ Explicit route dengan nama unik — HARUS sebelum resource
    Route::get('/roles/datatable',          [RoleController::class,            'dataTable'])->name('roles.datatable');
    Route::get('/users/datatable',          [UserController::class,            'dataTable'])->name('users.datatable');
    Route::get('/ticketing/datatable',      [MasterTicketingController::class, 'dataTable'])->name('ticketing.datatable');
    Route::get('/project-header/datatable', [ProjectHeaderController::class,   'dataTable'])->name('project-header.datatable');

    // Resource routes
    Route::resource('roles',          RoleController::class);
    Route::resource('users',          UserController::class);
    Route::resource('ticketing',      MasterTicketingController::class);
    Route::resource('project-header', ProjectHeaderController::class);

    Route::resource('project-header.information', ProjectInformationController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('project-header.detail', ProjectDetailController::class)
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
});
