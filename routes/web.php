<?php

use App\Http\Controllers\TrainerUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\ExcerciseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StaticsController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserTrainerRequestController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/workouts', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
    Route::get('/workout/edit/{workout}', [WorkoutController::class, 'edit'])->name('workouts.edit');
    Route::put('/workouts/{workout}', [WorkoutController::class, 'update'])->name('workouts.update');
    Route::delete('/workouts/{workout}', [WorkoutController::class, 'destroy'])->name('workouts.destroy');


    Route::post('/clusters', [ClusterController::class, 'store'])->name('clusters.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/clients', [TrainerUserController::class, 'index'])->name('clients.index');
    Route::get('/statics/{user?}', [StaticsController::class, 'index'])->name('statics.index');
    Route::get('/excercise-statics/{excercise}/{user?}/{initialDate?}/{endDate?}', [StaticsController::class, 'excerciseStatics'])->name('statics.excercise');

    Route::get('/trainers', [TrainerUserController::class, 'trainersIndex'])->name('trainers.index');


    Route::get('/excercises', [ExcerciseController::class, 'index'])->name('excercises.index');


    Route::post('/user-trainer-request', [UserTrainerRequestController::class, 'store'])->name('user-trainer-request.store');
    Route::get('/user-trainer-request-accept/{token}', [UserTrainerRequestController::class, 'accept'])->name('user-trainer-request.accept');

});


Route::post('send-contact-form', [MailController::class, 'sendContactForm'])->name('mail.contact-form');

require __DIR__.'/auth.php';
