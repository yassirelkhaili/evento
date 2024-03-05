<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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
Route::get('/', [Controller::class, 'index'])->name("index");

Route::get("advert/show/{id}", [Controller::class, "showAdvert"])->name("adverts.show");

Route::middleware(['auth'])->group(function () {
    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//auth routes
Route::middleware(['auth'])->group(function () {

});

Route::middleware(['auth', 'can:manage users'])->group(function () {
Route::get('/dashboard/users', [UserController::class, 'index'])->name('user.index');
Route::post('dashboard/users/create', [UserController::class,'store'])->name('user.store');
Route::put("dashboard/users/{user}", [UserController::class,"update"])->name("user.update");
Route::delete("dashboard/users/{user}", [UserController::class,"destroy"])->name("user.destroy");
Route::get("/dashboard/users/{user}", [UserController::class,"show"])->name("user.show");
});

require __DIR__ . '/auth.php';