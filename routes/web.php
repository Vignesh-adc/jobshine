<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\JobseekerDataController;
use App\Http\Controllers\PageController;



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

//Job Seeker Data Controller
Route::get('/', [PageController::class, 'login'])->name('login');
Route::get('jobseekers', [JobseekerDataController::class, 'index'])->name('home');
Route::get('jobseekers/datatables', [JobseekerDataController::class, 'getJobseekers']);
Route::get('/jobseeker/{id}', [JobseekerDataController::class, 'getJobseeker']);

//Sample Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/logout', [PageController::class, 'logout'])->name('logout');