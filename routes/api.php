<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\StaticsController;
use App\Http\Controllers\TrainerUserController;
use App\Http\Controllers\ExcerciseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function(){

    Route::get('/workouts/{startDate?}/{endDate?}', [WorkoutController::class, 'get']);
    Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
    Route::delete('/workouts/{workout}', [WorkoutController::class, 'destroy'])->name('workouts.destroy');
    Route::put('/workouts/{workout}', [WorkoutController::class, 'update'])->name('workouts.update');

    Route::get('/clusters/{workout}', [ClusterController::class, 'getByWorkout'])->name('clusters.getByWorkout');
    Route::post('/clusters', [ClusterController::class, 'store'])->name('clusters.store');
    Route::put('/clusters/{cluster}', [ClusterController::class, 'update'])->name('clusters.update');
    Route::delete('/clusters/{cluster}', [ClusterController::class, 'destroy'])->name('clusters.destroy');


    Route::get('/trainer/clients/{user}', [TrainerUserController::class, 'getClientsByTrainer'])->name('trainer.clients');
    Route::post('/trainer/clients', [TrainerUserController::class, 'store'])->name('trainer.clients.store');
    Route::delete('/trainer/clients/{trainerUser}', [TrainerUserController::class, 'destroy'])->name('trainer.clients.destroy');

    Route::get('/trainer/possible-clients/{search?}', [TrainerUserController::class, 'getPossibleClients'])->name('trainer.possible-clients');

    Route::get('statics-workout-abstract/{user}/{initialDate?}/{endDate?}', [StaticsController::class, 'getWorkoutsAbstract'])->name('statics.workouts-abstract');
    Route::get('statics-per-excercise/{user}/{initialDate?}/{endDate?}', [StaticsController::class, 'staticsPerExcercise'])->name('statics.per-excercise');
    Route::get('statics-excercise-data/{excercise}/{user}/{initialDate?}/{endDate?}', [StaticsController::class, 'getExcerciseData'])->name('statics.excercise-data');
    Route::get('statics-excercise-usage/{excercise}/{user}/{initialDate?}/{endDate?}', [StaticsController::class, 'getExcerciseUsage'])->name('statics.excercise-usage');


    Route::get('/excercises', [ExcerciseController::class, 'get'])->name('excercises.get');


});