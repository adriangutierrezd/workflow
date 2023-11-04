<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\ClusterController;

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

    Route::get('/workouts', [WorkoutController::class, 'get']);
    Route::post('/workouts', [WorkoutController::class, 'store'])->name('workouts.store');
    Route::delete('/workouts/{workout}', [WorkoutController::class, 'destroy'])->name('workouts.destroy');
    Route::put('/workouts/{workout}', [WorkoutController::class, 'update'])->name('workouts.update');

    Route::get('/clusters/{workout}', [ClusterController::class, 'getByWorkout'])->name('clusters.getByWorkout');
    Route::post('/clusters', [ClusterController::class, 'store'])->name('clusters.store');
    Route::delete('/clusters/{cluster}', [ClusterController::class, 'destroy'])->name('clusters.destroy');


});