<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;

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

//render routes
Route::get('/', [EventController::class, 'index'])->name("index");

Route::get("event/show/{id}", [EventController::class, "show"])->name("event.show");

Route::middleware(['auth'])->group(function () {
    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//auth routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [Controller::class, 'index'])->name('index.dashboard');
});

Route::middleware(['auth', 'can:manage users'])->group(function () {
Route::get('/dashboard/users', [UserController::class, 'index'])->name('user.index');
Route::post('dashboard/users/create', [UserController::class,'store'])->name('user.store');
Route::put("dashboard/users/{user}", [UserController::class,"update"])->name("user.update");
Route::delete("dashboard/users/{user}", [UserController::class,"destroy"])->name("user.destroy");
Route::get("/dashboard/users/{user}", [UserController::class,"show"])->name("user.show");
});

require __DIR__ . '/auth.php';