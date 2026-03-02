<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Usermanagement;
use Illuminate\Support\Facades\Route;

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
});

require __DIR__.'/auth.php';

Route::get('/user-management', [Usermanagement::class, 'index'])->name('user-management.index');
Route::get('/getRoles', [Usermanagement::class, 'getRoles'])->name('getRoles');
Route::get('/userDetails', [Usermanagement::class, 'userDetails'])->name('userDetails');
Route::get('/getEmployeeId', [Usermanagement::class, 'getEmployeeId'])->name('getEmployeeId');
Route::post('/addUser', [Usermanagement::class, 'addUser'])->name('addUser');
