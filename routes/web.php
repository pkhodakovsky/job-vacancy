<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JobVacancyResponseController;
use App\Http\Controllers\LikeController;

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
    return Inertia::render('Welcome', [
        'canLogin'    => Route::has('login'),
        'canRegister' => Route::has('register'),

    ]);
});
Route::get('/vacancy/{id}', function ($id) {
    return Inertia::render('JobVacancyPage', [
        'canLogin'    => Route::has('login'),
        'id'          => $id,
        'canRegister' => Route::has('register'),
    ]);
});
Route::resource('jobresponse', JobVacancyResponseController::class);
Route::resource('jobs', JobVacancyController::class);
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('like', LikeController::class);
    Route::resource('/dashboard', DashboardController::class);
});


require __DIR__ . '/auth.php';
