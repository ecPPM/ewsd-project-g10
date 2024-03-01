<?php

use App\Http\Controllers\AllocationController;
use App\Http\Controllers\StudentsController;
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

//Route::view('/students', 'students')->middleware(['auth', 'role:admin'])->name('students');

Route::middleware(['auth', 'role:admin'])->get('/students', [StudentsController::class, 'students'])->name('students');

Route::middleware(['auth', 'role:admin'])->get('/students/{id}', [StudentsController::class, 'studentDetails'])->name('students-details');


//Route::view('/students/{studentId}', 'students-details')->middleware(['auth', 'role:admin'])->name('students-detail');

Route::middleware(['auth', 'role:tutor,student'])->get('/dashboard', [AllocationController::class, 'dashboard'])->name('dashboard');


Route::middleware(['auth', 'role:tutor,student'])->get('/dashboard', [AllocationController::class, 'dashboard'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->get('/allocation', [AllocationController::class, 'allocation'])->name('allocation');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
