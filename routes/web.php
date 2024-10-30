<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->middleware(['password.confirm'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'updateInfo'])->name('profile.info');

    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


// Listing Routes
Route::get('/', [ListingController::class, 'index'])->name('home');
Route::resource('listings', ListingController::class)->except('index');


// Admin Routes

Route::middleware(['auth', 'verified', Admin::class])
    ->controller(AdminController::class)
    ->group(function(){

    Route::get('/admin',  'index')->name('admin.index');

    Route::put('/admin/{user}/role',  'role')->name('admin.role');

    Route::get('/user/{id}',  'show')->name('admin.show');

    Route::put('/admin/{id}/approved',  'approved')->name('admin.approved');

});


// Auth Routes
require __DIR__ . '/auth.php';

