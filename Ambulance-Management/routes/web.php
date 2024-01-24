<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
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
    $roleName = 'doctor';
    // Retrieve users with the specified role
    $users = User::whereHas('roles', function ($query) use ($roleName) {
        $query->where('name', $roleName);
    })->take(4)->get();
    return view('welcome', compact('users'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/details/{id}', [ProfileController::class, 'details'])->name('profile.details');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/employees/{type?}', [ProfileController::class, 'index'])->name('profile.index');  
    Route::match(['post', 'delete'], '/profile/delete/{id}', [ProfileController::class, 'del'])->name('profile.delete');

});
Route::middleware('role:admin')->group(function () {
   
});
Route::resource('/reports', ReportController::class);

Route::resource('/appointments',AppointmentController::class);
Route::post('/appointments/{appointment}/toggle-approval', [AppointmentController::class, 'toggleApproval'])->name('appointments.toggleApproval');
require __DIR__.'/auth.php';
