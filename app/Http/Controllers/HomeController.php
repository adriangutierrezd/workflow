<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    
    public function index(){

        $initialDate = date('Y-m-d', strtotime('monday this week'));
        $endDate = date('Y-m-d', strtotime('sunday this week'));

        if (!Auth::user()->isTrainer()) {
            return view('user.dashboard', compact('initialDate', 'endDate'));
        }

        $weekDays = [];
        for($i = 0; $i < 7; $i++){
            $newDate = date('Y-m-d', strtotime($initialDate." + ".$i." days"));
            $dayData = [
                'date' => $newDate,
                'number' => date('d', strtotime($newDate)),
                'name' => date('l', strtotime($newDate))
            ];
        
            $weekDays[] = $dayData;
        }


        $workouts = Workout::whereBetween('date', [$initialDate, $endDate])
        ->where(function(Builder $query){
            $query->where('user_id', Auth::user()->id)
            ->orWhere('owner_id', Auth::user()->id);
        })->with('status', 'user')->get();

        $workoutsByStatus = $workouts->groupBy('status.name');
        $workoutsByDate = $workouts->groupBy('date');
        
        return view('trainer.dashboard', compact('workouts', 'workoutsByStatus', 'weekDays', 'workoutsByDate', 'initialDate', 'endDate'));

    }

}
