<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GymController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::resource('/members' , GymController::class);
    Route::get('/will-expire-two-days', [GymController::class, 'twoDaysBeforeExpireMailSender']);
    Route::get('/will-expire-three-days', [GymController::class, 'threeDaysBeforeExpireMailSender']);
    Route::get('/expired-memberships', [GymController::class, 'membershipsExpired']);

});
require __DIR__.'/auth.php';
