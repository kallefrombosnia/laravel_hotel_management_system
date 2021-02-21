<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
    Public routes
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/', [ReservationController::class, 'createReservation'])->name('reservation');

Route::get('/admin', [DashboardController::class, 'index'])->name('admin');

Route::get('/login', [DashboardController::class, 'index'])->name('login');

Route::get('/register', [DashboardController::class, 'index'])->name('register');

Route::get('/logout', [DashboardController::class, 'index'])->name('logout');

/*
    Private routes
*/