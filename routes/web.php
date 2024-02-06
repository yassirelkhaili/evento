<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdvertController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\PartnerController;
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
Route::get('/', [Controller::class, 'index'])->name("index");

Route::get("advert/show/{id}", [Controller::class, "showAdvert"])->name("adverts.show");

//show dashboard routes
Route::get('/dashboard', [AdvertController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/partners', [PartnerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.partners');

//auth routes
Route::middleware(['auth', 'can:access-admin-dashboard'])->group(function () {
    //crud routes
    Route::prefix('partner')->group(function () {
        Route::resource('partner', PartnerController::class);
    });
    Route::prefix("advert")->group(function () {
        Route::resource('advert', AdvertController::class);
    });

    //application routes
    Route::prefix('application')->group(function () {
        Route::resource('application', ApplicationsController::class);
    });
    
    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
