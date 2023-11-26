<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Http\JsonResponse;

class StaticsController extends Controller
{

    public function index(Request $request, ?User $user = null){
        $initialDate = date('Y-m-d', strtotime('monday this week'));
        $endDate = date('Y-m-d', strtotime('sunday this week'));
        return view('statics.index', compact('initialDate', 'endDate'));
    }

    public function getWorkoutsAbstract(Request $request, User $user, string $initialDate = null, string $endDate = null): JsonResponse
    {

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
            'message' => 'Data fetched',
            'data' => [
                'workoutsByStatus' => $workoutsByStatus,
                'totalWorkouts' => count($workouts)
            ],
            'from' => $dateFrom,
            'to' => $dateTo
        ]);

    }

}
