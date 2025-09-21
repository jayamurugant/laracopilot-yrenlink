<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EndUserController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// EndUser Routes
Route::get('/enduser/dashboard', [EndUserController::class, 'dashboard'])->name('enduser.dashboard');
Route::get('/enduser/listings', [EndUserController::class, 'listings'])->name('enduser.listings');
Route::get('/enduser/listing/{id}', [EndUserController::class, 'viewListing'])->name('enduser.listing.view');
Route::get('/enduser/bookings', [EndUserController::class, 'bookings'])->name('enduser.bookings');

// Creator Routes
Route::get('/creator/dashboard', [CreatorController::class, 'dashboard'])->name('creator.dashboard');
Route::get('/creator/listings', [CreatorController::class, 'listings'])->name('creator.listings');
Route::get('/creator/listings/create', [CreatorController::class, 'createListing'])->name('creator.listings.create');
Route::post('/creator/listings', [CreatorController::class, 'storeListing'])->name('creator.listings.store');
Route::get('/creator/listings/{id}/edit', [CreatorController::class, 'editListing'])->name('creator.listings.edit');
Route::put('/creator/listings/{id}', [CreatorController::class, 'updateListing'])->name('creator.listings.update');
Route::delete('/creator/listings/{id}', [CreatorController::class, 'deleteListing'])->name('creator.listings.delete');
Route::get('/creator/bookings', [CreatorController::class, 'bookings'])->name('creator.bookings');

// SuperAdmin Routes
Route::get('/superadmin/dashboard', [SuperAdminController::class, 'dashboard'])->name('superadmin.dashboard');
Route::get('/superadmin/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
Route::get('/superadmin/listings', [SuperAdminController::class, 'listings'])->name('superadmin.listings');
Route::get('/superadmin/bookings', [SuperAdminController::class, 'bookings'])->name('superadmin.bookings');
Route::get('/superadmin/payments', [SuperAdminController::class, 'payments'])->name('superadmin.payments');
Route::delete('/superadmin/users/{id}', [SuperAdminController::class, 'deleteUser'])->name('superadmin.users.delete');
Route::delete('/superadmin/listings/{id}', [SuperAdminController::class, 'deleteListing'])->name('superadmin.listings.delete');

// Booking Routes
Route::post('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::get('/booking/{id}/payment', [BookingController::class, 'payment'])->name('booking.payment');

// Payment Routes
Route::post('/payment/razorpay', [PaymentController::class, 'razorpay'])->name('payment.razorpay');
Route::post('/payment/stripe', [PaymentController::class, 'stripe'])->name('payment.stripe');
Route::post('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

// File Upload Route
Route::post('/upload/image', [ListingController::class, 'uploadImage'])->name('upload.image');