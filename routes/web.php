<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddController;




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

Route::get('/', [IndexController::class, 'showIndex']);

Route::post('/register', [UserController::class, 'register']);
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('registration');
Route::get('/activate/{token}', [UserController::class, 'activate'])->name('activate');



Route::get('/login', [IndexController::class, 'showLogin']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/profil', [UserController::class, 'showProfile'])->name('profile.show');
Route::get('/profil/edit', [UserController::class, 'editProfile'])->name('profile.edit');
Route::post('/profil/update', [UserController::class, 'updateProfile'])->name('profile.update');
Route::delete('/profil/supprimer', [UserController::class, 'deleteAccount'])->name('profile.delete');


Route::get('/adds/create', [AddController::class, 'create'])->name('adds.create');
Route::post('/adds', [AddController::class, 'store'])->name('adds.store');
Route::get('/home', [AddController::class, 'index'])->name('home');


Route::get('/adds/{add}/edit', [AddController::class, 'edit'])->name('adds.edit');
Route::put('/adds/{add}', [AddController::class, 'update'])->name('adds.update');
Route::delete('/adds/{add}', [AddController::class, 'destroy'])->name('adds.destroy');

Route::get('/search', [AddController::class, 'search'])->name('adds.search');
Route::get('/adds/{add}', [AddController::class, 'show'])->name('adds.show');



use App\Http\Controllers\MessageController;
Route::resource('messages', MessageController::class)->middleware('auth');
