<?php

namespace App\Http\Controllers;

use App\Models\Excercise;
use App\Models\User;
use App\Models\Workout;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class StaticsController extends Controller
{

    public function index(Request $request, ?User $user = null){

        if(!Gate::allows('see-statics', $user)){
            abort(403);
        }
            
        $initialDate = date('Y-m-d', strtotime('monday this week'));
        $endDate = date('Y-m-d', strtotime('sunday this week'));
        $targetUser = !$user ? $request->user()->id : $user->id;
        return view('statics.index', compact('initialDate', 'endDate', 'targetUser'));
    }

    public function excerciseStatics(Request $request, Excercise $excercise, ?User $user = null, string $initialDate = null, string $endDate = null)
    {

        if($user && !Gate::allows('see-statics', $user)){
            abort(403);
        }

        $defaultInitialDate = date('Y-m-d', strtotime('monday this week'));
        $defaultEndDate = date('Y-m-d', strtotime('sunday this week'));

        if((!$initialDate || !$endDate) ||
        ($defaultEndDate == $endDate && $defaultInitialDate == $initialDate)){
            $initialDate = date('Y-m-d', strtotime('last monday', strtotime('-3 months')));
            $endDate = date('Y-m-d', strtotime('sunday this week'));
        }

        $targetUser = !$user ? $request->user()->id : $user->id;

        return view('statics.excercise', compact('excercise', 'initialDate', 'endDate', 'targetUser'));
    }

    public function getWorkoutsAbstract(Request $request, User $user, string $initialDate = null, string $endDate = null): JsonResponse
    {

        if(!Gate::allows('see-statics', $user)){
            return response()->json(['error' => __('Not authorized')], 403);
        }

        $initialTimeStr = !$initialDate ? 'monday this week' : $initialDate;
        $endTimeStr = !$endDate ? 'sunday this week' : $endDate;

        $dateFrom = date('Y-m-d', strtotime($initialTimeStr));
        $dateTo = date('Y-m-d', strtotime($endTimeStr));


        $workouts = Workout::where('user_id', $user->id)
        ->whereBetween('date', [$dateFrom, $dateTo])
        ->with('status', 'user')
        ->get();

        $workoutsByStatus = $workouts->groupBy('status.name');

        return response()->json([
            'message' => __('Data successfully obtained'),
            'data' => [
                'workoutsByStatus' => $workoutsByStatus,
                'totalWorkouts' => count($workouts)
            ],
            'from' => $dateFrom,
            'to' => $dateTo
        ]);

    }

    public function staticsPerExcercise(Request $request, User $user, string $initialDate = null, string $endDate = null): JsonResponse
    {
        if(!Gate::allows('see-statics', $user)){
            return response()->json(['error' => __('Not authorized')], 403);
        }

        $initialTimeStr = !$initialDate ? 'monday this week' : $initialDate;
        $endTimeStr = !$endDate ? 'sunday this week' : $endDate;

        $dateFrom = date('Y-m-d', strtotime($initialTimeStr));
        $dateTo = date('Y-m-d', strtotime($endTimeStr));

        $results = DB::table('workouts as w')
        ->select(
            'e.name',
            'e.id as excercise_id',
            DB::raw('SUM(c.sets) as sets'),
            DB::raw('SUM(c.sets * c.reps) as reps'),
            DB::raw('COUNT(DISTINCT(w.id)) as workout_appearences'),
            DB::raw('ROUND(SUM(c.weight * c.sets * c.reps) / SUM(c.sets * c.reps), 2) as average_weight')
        )
        ->join('clusters as c', 'c.workout_id', '=', 'w.id')
        ->join('excercises as e', 'c.excercise_id', '=', 'e.id')
        ->where('w.user_id', $user->id)
        ->whereBetween('w.date', [$dateFrom, $dateTo])
        ->where('c.done', 1)
        ->groupBy('e.id', 'e.name')
        ->get();

        return response()->json([
            'message' => __('Data successfully obtained'),
            'data' => $results,
            'from' => $dateFrom,
            'to' => $dateTo
        ]);
    }

    public function getExcerciseData(Request $request, Excercise $excercise, User $user, string $initialDate = null, string $endDate = null): JsonResponse
    {
        if(!Gate::allows('see-statics', $user)){
            return response()->json(['error' => __('Not authorized')], 403);
        }

        $initialTimeStr = !$initialDate ? 'monday this week' : $initialDate;
        $endTimeStr = !$endDate ? 'sunday this week' : $endDate;

        $dateFrom = date('Y-m-d', strtotime($initialTimeStr));
        $dateTo = date('Y-m-d', strtotime($endTimeStr));

        $results = DB::table('workouts as w')
        ->select(
            'w.id',
            'w.date',
            DB::raw('ROUND(SUM(c.sets * c.reps * c.weight) / SUM(c.sets * c.reps), 2) AS average_weight_per_workout'),
            DB::raw('ROUND(SUM(c.sets * c.reps * c.weight), 2) AS total_weight_per_workout')
        )
        ->join('clusters as c', 'c.workout_id', '=', 'w.id')
        ->where('w.user_id', '=', $user->id)
        ->whereBetween('w.date', [$dateFrom, $dateTo])
        ->where('c.done', '=', '1')
        ->where('c.excercise_id', '=', $excercise->id)
        ->groupBy('w.id', 'w.date')
        ->orderBy('w.date', 'asc')
        ->get();

        return response()->json([
            'message' => __('Data successfully obtained'),
            'data' => $results,
            'from' => $dateFrom,
            'to' => $dateTo
        ]);
    }

    public function getExcerciseUsage(Request $request, Excercise $excercise, User $user, string $initialDate = null, string $endDate = null): JsonResponse
    {
        if(!Gate::allows('see-statics', $user)){
            return response()->json(['error' => __('Not authorized')], 403);
        }

        $initialTimeStr = !$initialDate ? 'monday this week' : $initialDate;
        $endTimeStr = !$endDate ? 'sunday this week' : $endDate;

        $dateFrom = date('Y-m-d', strtotime($initialTimeStr));
        $dateTo = date('Y-m-d', strtotime($endTimeStr));

        $results = DB::table('workouts as w')
        ->selectRaw('DAYOFWEEK(w.date) AS DAY, w.date, SUM(c.sets) AS sets')
        ->join('clusters as c', 'c.workout_id', '=', 'w.id')
        ->where('w.user_id', '=', $user->id)
        ->whereBetween('w.date', [$dateFrom, $dateTo])
        ->where('c.done', '=', '1')
        ->where('c.excercise_id', '=', $excercise->id)
        ->groupBy('w.date')
        ->orderBy('w.date', 'asc')
        ->get();

        $results = $results->map(function($elm){
            $elm->week = date('W', strtotime($elm->date));
            $elm->year = date('o', strtotime($elm->date));
            $elm->wkyr = $elm->year."-".$elm->week;
            return $elm;
        });

        $uniqueWeeks = $results->pluck('wkyr', 'date')->unique()->toArray();

        $dateFromObj = new DateTime($dateFrom);
        $dateToObj = new DateTime($dateTo);
        $interval = new DateInterval('P1W');
        $dateRange = new DatePeriod($dateFromObj, $interval, $dateToObj);

        $allWeeks = [];
        foreach ($dateRange as $date) {
            $week = $date->format('W');
            $year = $date->format('o');
            $allWeeks[$date->format('Y-m-d')] = "$year-$week";
        }

        $missingWeeks = array_diff($allWeeks, $uniqueWeeks);
        $missingResults = collect();
        foreach ($missingWeeks as $date => $value) {
            $missingResults->push((object)[
                'week' => date('W', strtotime($date)),
                'year' => date('o', strtotime($date)),
                'wkyr' => $value,
                'date' => $date,
                'sets' => 0
            ]);
        }


        $results = $results->merge($missingResults)->sortBy('date')->values();

        return response()->json([
            'message' => __('Data successfully obtained'),
            'data' => $results,
            'from' => $dateFrom,
            'to' => $dateTo
        ]);
    }




}
