<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Cluster;

class ShowWorkoutController extends Controller{
    public function __invoke(Workout $workout){
        $clusters = Cluster::where('workout_id', $workout->id)->get();

        return view('workouts.show', compact('workout', 'clusters'));
    }
}
