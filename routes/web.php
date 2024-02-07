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

Route::middleware(['auth'])->group(function () {
    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //show learner dashboard routes
    Route::get('/dashboard/applications', [ApplicationsController::class, 'index'])->name("dashboard.applications");
    //application routes
    Route::delete("/application/{application}", [ApplicationsController::class, "destroy"])->name("application.destroy");
});

//auth routes
Route::middleware(['auth', 'can:access-admin-dashboard'])->group(function () {
    //show Admin dashboard routes
    Route::get('/dashboard/partners', [PartnerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.partners');
    Route::get('/dashboard', [AdvertController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    //crud routes
    Route::prefix('partner')->group(function () {
        Route::resource('partner', PartnerController::class);
    });
    Route::prefix("advert")->group(function () {
        Route::resource('advert', AdvertController::class);
    });
});

require __DIR__ . '/auth.php';
