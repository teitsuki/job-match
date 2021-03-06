<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\EntryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [JobOfferController::class, 'index'])
    ->name('root')
    ->middleware('auth:companies,users');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome')
    ->middleware('guest:companies,users');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

require __DIR__ . '/auth.php';

Route::resource('job_offers', JobOfferController::class)
    ->only(['create', 'store', 'edit', 'update', 'destroy'])
    ->middleware('auth:companies');

Route::resource('job_offers', JobOfferController::class)
    ->only(['show', 'index'])
    ->middleware('auth:companies,users');

Route::patch('/job_offers/{job_offer}/entries/{entry}/approval', [App\Http\Controllers\EntryController::class, 'approval'])
    ->name('job_offers.entries.approval')
    ->middleware(['auth:companies']);

Route::patch('/job_offers/{job_offer}/entries/{entry}/reject', [App\Http\Controllers\EntryController::class, 'reject'])
    ->name('job_offers.entries.reject')
    ->middleware(['auth:companies']);
    
Route::resource('job_offers.entries', EntryController::class)
    ->only(['store', 'destroy'])
    ->middleware('auth:users');