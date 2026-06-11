<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\WelcomeController;
Route::get('/', [WelcomeController::class,'welcome'])->name('welcome');

Route::get('/register', [AuthController::class,'showRegister']);
Route::post('/register', [AuthController::class,'register'])->name('register');

Route::get('/login', [AuthController::class,'showLogin']);
Route::post('/login', [AuthController::class,'login'])->name('login');

Route::middleware(['auth'])->group(function(){
    Route::get('/appointments', [AppointmentController::class,'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class,'create'])->name('appointments.create');
    Route::post('/appointments/store', [AppointmentController::class,'store'])->name('appointments.store');
    Route::get('/appointments/{id}/edit', [AppointmentController::class,'edit'])->name('appointments.edit');
    Route::put('/appointments/update/{id}', [AppointmentController::class,'update'])->name('appointments.update');
});

Route::middleware(['auth','admin'])->group(function(){
     Route::get('/admin', [AdminController::class,'index'])->name('admin.index');
     Route::put('/admin/{appointment}', [AdminController::class,'updateStatus'])->name('admin.updateStatus');
});

Route::post('/logout', [AuthController::class,'logout'])->name('logout');
