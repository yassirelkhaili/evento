<?php

use App\Http\Controllers\PartnerController;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
Route::get('/', function () {return view('welcome');});
Route::get('/dashboard', [AdvertController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/partners', [PartnerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.partners');

//crud routes
Route::prefix('partner')->group(function () {
    Route::resource('partner', PartnerController::class);
});
Route::prefix("advert")->group(function () {
});

//auth routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
