<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Workout;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    
    public function index(){

        if (!Auth::user()->isTrainer()) {
            return view('user.dashboard');
        }

        $start_date = date('Y-m-d', strtotime('monday this week'));
        $end_date = date('Y-m-d', strtotime('sunday this week'));


        $weekDays = [];
        $startDate = date('Y-m-d', strtotime('monday this week'));
        $endDate = date('Y-m-d', strtotime('sunday this week'));
        
        for($i = 0; $i < 7; $i++){
            $newDate = date('Y-m-d', strtotime($startDate." + ".$i." days"));
            $dayData = [
                'date' => $newDate,
                'number' => date('d', strtotime($newDate)),
                'name' => date('l', strtotime($newDate))
            ];
        
            $weekDays[] = $dayData;
        }


        $workouts = Workout::whereBetween('date', [$start_date, $end_date])
        ->where(function(Builder $query){
            $query->where('user_id', Auth::user()->id)
            ->orWhere('owner_id', Auth::user()->id);
        })->with('status')->get();

        $workoutsByStatus = $workouts->groupBy('status.name');
        
        return view('trainer.dashboard', compact('workouts', 'workoutsByStatus', 'weekDays'));

    }

}
