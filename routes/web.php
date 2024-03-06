<?php

use App\Http\Controllers\superadminController;
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

Route::view('/', 'welcome');

Route::get('/dashboard', [superadminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/allusers', [superadminController::class, 'allUsers'])->middleware(['auth', 'verified'])->name('UserManagement');
Route::get('/dashboard/adduser', [superadminController::class, 'addUser'])->middleware(['auth', 'verified'])->name('addUser');
Route::get('/dashboard/edituser', [superadminController::class, 'editUser'])->middleware(['auth', 'verified'])->name('editUser');


Route::get('/dashboard/allSurvay', [superadminController::class, 'allSurvay'])->middleware(['auth', 'verified'])->name('allSurvay');
Route::get('/dashboard/createSurvay', [superadminController::class, 'createSurvay'])->middleware(['auth', 'verified'])->name('createSurvay');

Route::get('/dashboard/viewSurvay', [superadminController::class, 'viewSurvay'])->middleware(['auth', 'verified'])->name('viewSurvay');

Route::get('/sendSurvayInvite',[superadminController::class,'sendSurvayInvite'])->middleware(['auth', 'verified'])->name('sendSurvayInvite');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
