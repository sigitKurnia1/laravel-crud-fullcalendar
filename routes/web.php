<?php

use App\Http\Controllers\event\EventController;
use App\Http\Controllers\user\UserController;
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

//Event route
Route::get('/', [EventController::class, 'index']);
Route::get('/get-events', [EventController::class, 'getEvents']);
Route::post('/create-event', [EventController::class, 'createEvent'])->name('create-event');
Route::get('/search-events', [EventController::class, 'searchEvents']);
Route::get('/export-events', [EventController::class, 'exportEvents'])->name('export-events');
Route::get('/event-list', [EventController::class, 'eventList']);
Route::get('/get-event/{id}', [EventController::class, 'getEventId']);
Route::post('/update-event/{id}', [EventController::class, 'updateEvent']);
Route::get('/delete-event/{id}', [EventController::class, 'deleteEvent'])->name('delete-event');

//User route
Route::get('/user-data', [UserController::class, 'index'])->name('user-data');
Route::get('/add-user', [UserController::class, 'storeView'])->name('add-user');
Route::post('/store-user', [UserController::class, 'store'])->name('store-user');
Route::get('/update-user/{id}', [UserController::class, 'updateView'])->name('update-user');
Route::post('/update-user-data/{id}', [UserController::class, 'update'])->name('update-user-data');
Route::delete('/destroy-user/{id}', [UserController::class, 'destroy'])->name('destroy-user');