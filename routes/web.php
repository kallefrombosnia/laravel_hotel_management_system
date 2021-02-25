<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

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


/*
    Private routes
*/


Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm'  => false, 
    'verify'   => false,  
]);


Route::get('/admin', [AdminController::class, 'index'])->name('admin');
