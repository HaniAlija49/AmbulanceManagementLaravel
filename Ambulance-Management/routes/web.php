<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/employees/{type?}', [ProfileController::class, 'index'])->name('profile.index');  
});
Route::middleware('role:admin')->group(function () {
    Route::get('/profile/{id?}', [ProfileController::class, 'edit'])->name('profile.edit');
   
});
Route::resource('/reports', ReportController::class);

Route::resource('/appointments',AppointmentController::class);
Route::post('/appointments/{appointment}/toggle-approval', [AppointmentController::class, 'toggleApproval'])->name('appointments.toggleApproval');
require __DIR__.'/auth.php';
