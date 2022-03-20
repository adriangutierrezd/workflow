<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Workout;
use App\Models\Cluster;
use Illuminate\Support\Facades\DB;

class AverageWeightPerRep extends BaseChart{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan{

        $dates =  [];
        $weights = [];
        $excercise_id = $request->excercise_id;
        $excercise_name = $request->excercise_name;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        // Obtenemos los clusters con el ejercicio solicitado
        $clusters = Cluster::where('user_id', auth()->user()->id)->where('excercise_id', $excercise_id)->get();

        // Obtenemos los Workouts->ids de los entrenamientos en los que se han usado esos ejercicios
        $workout_ids = [];
        foreach($clusters as $clus){
            $id = $clus->workout_id;
            array_push($workout_ids, $id);
        }

        // Obtenemos dichos entrenamientos
        $workouts = Workout::whereIn('id', $workout_ids)->whereBetween('date', [$start_date, $end_date])->orderBy('date', 'asc')->get();
        // Sacamos sus fechas
        foreach($workouts as $wk){
            $date = date('d/m/y', strtotime($wk->date));
            array_push($dates, $date);
        }

        // Obtenemos el peso levantado en cada entrenamiento
        foreach($workouts as $wk){
            $temp_reps = [];
            $temp_wh = [];
            $clusters = Cluster::where('workout_id', $wk->id)->where('excercise_id', $excercise_id)->get();
            foreach($clusters as $clus){
                $weight = $clus->sets * $clus->reps * $clus->weight;
                $reps = $clus->sets * $clus->reps;
                array_push($temp_reps, $reps);
                array_push($temp_wh, $weight);
            }
            $result = array_sum($temp_wh)/array_sum($temp_reps);
            array_push($weights, round($result, 2));
        }

        return Chartisan::build()
            ->labels($dates)
            ->dataset($excercise_name, $weights);
    }
}