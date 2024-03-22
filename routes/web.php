<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UserController;
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

//Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

Route::middleware(['auth', 'role:tutor,student'])->get('/meetings', [UserController::class, 'meetings'])->name('meetings');
Route::middleware(['auth', 'role:tutor,student'])->get('/blog', [UserController::class, 'blog'])->name('blog');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
//Route::middleware(['auth', 'role:admin'])->get('/allocation', [AllocationController::class, 'allocation'])->name('allocation');

Route::middleware(['auth', 'role:admin'])->get('/students', [AdminController::class, 'students'])->name('students');

Route::middleware(['auth', 'role:admin'])->get('/students/{id}', [AdminController::class, 'studentDetails'])->name('students-details');

Route::middleware(['auth', 'role:admin'])->get('/tutors', [AdminController::class, 'tutors'])->name('tutors');

Route::middleware(['auth', 'role:admin'])->get('/tutors', [AdminController::class, 'tutors'])->name('tutors');

Route::middleware(['auth', 'role:admin'])->get('/tutors/{id}', [AdminController::class, 'tutorDetails'])->name('tutor-details');

Route::middleware(['auth', 'role:admin'])->get('/reports', [AdminController::class, 'reports'])->name('reports');

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
