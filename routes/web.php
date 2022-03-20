<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\ShowWorkoutController;

//use App\Http\Livewire\ExcerciseCategories;


use App\Http\Livewire\PoliticaDeCookies;
use App\Http\Livewire\PoliticaDePrivacidad;
use App\Http\Livewire\AvisoLegal;


use App\Http\Livewire\Excercises\Excercises;
use App\Http\Livewire\Workouts\Workouts;
use App\Http\Livewire\Workouts\EditWorkout;
use App\Http\Livewire\Workouts\CreateWorkout;
use App\Http\Livewire\Statics\Statics;
use App\Http\Livewire\Statics\ExcerciseStatics;
use App\Http\Livewire\Maximums\Maximums;
use App\Http\Livewire\Maximums\MaximumReps;
use App\Http\Livewire\ExcerciseCategories\ExcerciseCategories;

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
})->name('home');



Route::get('/politica-de-cookies', PoliticaDeCookies::class)->name('politica-de-cookies.show');
Route::get('/politica-de-privacidad', PoliticaDePrivacidad::class)->name('politica-de-privacidad.show');
Route::get('/aviso-legal', AvisoLegal::class)->name('aviso-legal.show');




Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-callback', function () {
    $user = Socialite::driver('google')->user();
    $userExists = User::where('external_id', $user->id)->where('external_auth', 'google')->first();
    if($userExists){
        Auth::login($userExists);
    }else{
        $userNew = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'external_id' => $user->id,
            'external_auth' => 'google'
        ]);

        Auth::login($userNew);
    }

    return redirect('/workouts');
});



Route::middleware(['auth'])->group(function(){

    Route::get('excercises', Excercises::class)->name('excercises.index');
    Route::get('maximums', Maximums::class)->name('maximums.index');
    Route::get('maximums/{mreExcercise}', MaximumReps::class)->name('maximums.show');
    Route::get('statics', Statics::class)->name('statics.index');
    Route::get('statics/{excercise}', ExcerciseStatics::class)->name('statics.show');
    Route::get('workouts', Workouts::class)->name('workouts.index');
    Route::get('workouts/{workout}', ShowWorkoutController::class)->name('workouts.show');
    Route::get('create-workout/{workout}', CreateWorkout::class)->name('workouts.create');
    Route::get('workouts/{workout}/edit', EditWorkout::class)->name('workouts.edit');

    // Administrador
    Route::middleware(['admin'])->group(function () {
        Route::get('excercise-categories', ExcerciseCategories::class)->name('excercise-categories.index');
    });



});
