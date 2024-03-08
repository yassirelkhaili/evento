<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

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
Route::get('/', [EventController::class, 'filter'])->name("index.filter");
Route::get("event/show/{id}", [EventController::class, "show"])->name("event.show");

Route::middleware(['auth'])->group(function () {
    //profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/tickets/create', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/dashboard/tickets', [TicketController::class, 'index'])->name('ticket.index');
});


Route::middleware(['auth', 'can:manage own events'])->group(function() {
    Route::get('/dashboard/events', [EventController::class, 'indexOwnEvents'])->name('organizer.events');
    Route::put('/dashboard/events/{event}', [EventController::class, 'update'])->name('event.update');
    Route::delete("dashboard/events/{event}", [EventController::class,"destroy"])->name("event.destroy");
    Route::post("dashboard/events/create", [EventController::class,"store"])->name("event.store");
});

Route::middleware(['auth', 'can:manage users'])->group(function () {
    Route::get('/dashboard', [EventController::class, 'showPendingEvents'])->name('index.dashboard');
    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('index.categories');
    Route::put('/dashboard/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete("dashboard/categories/{category}", [CategoryController::class,"destroy"])->name("category.destroy");
    Route::post("dashboard/categories/create", [CategoryController::class,"store"])->name("category.store");
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('user.index');
    Route::post('dashboard/users/create', [UserController::class,'store'])->name('user.store');
    Route::put("dashboard/users/{user}", [UserController::class,"update"])->name("user.update");
    Route::delete("dashboard/users/{user}", [UserController::class,"destroy"])->name("user.destroy");
    Route::get("/dashboard/users/{user}", [UserController::class,"show"])->name("user.show");
});

require __DIR__ . '/auth.php';