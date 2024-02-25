<?php

use App\Http\Controllers\AllocationController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login');

//Route::get('/etutor', [AllocationController::class, 'index'])->name('etutor');
//Route::get('/etutor/allocation', [AllocationController::class, 'index']);

Route::middleware(['auth', 'verified'])->get('/dashboard', [AllocationController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth', 'verified'])->get('/allocation', [AllocationController::class, 'allocation'])->name('allocation');

// Route::middleware(['auth'])->prefix('etutor')->group(function () {

// });

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
