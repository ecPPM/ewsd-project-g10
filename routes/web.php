<?php

use App\Http\Controllers\AllocationController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TutorsController;
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

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');


/*
|--------------------------------------------------------------------------
| Common Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:tutor,student'])->get('/dashboard', [AllocationController::class, 'dashboard'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->get('/allocation', [AllocationController::class, 'allocation'])->name('allocation');

Route::middleware(['auth', 'role:admin'])->get('/students', [StudentsController::class, 'students'])->name('students');

Route::middleware(['auth', 'role:admin'])->get('/students/{id}', [StudentsController::class, 'studentDetails'])->name('students-details');

Route::middleware(['auth', 'role:admin'])->get('/tutors', [TutorsController::class, 'tutors'])->name('tutors');

Route::middleware(['auth', 'role:admin'])->get('/tutors/{id}', [TutorsController::class, 'tutorDetails'])->name('tutor-details');

/*
|--------------------------------------------------------------------------
| Students Routes
|--------------------------------------------------------------------------
|
| Will be added here
|
*/

/*
|--------------------------------------------------------------------------
| Tutors Routes
|--------------------------------------------------------------------------
|
| Will be added here
|
*/


require __DIR__ . '/auth.php';
