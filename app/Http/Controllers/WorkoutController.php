<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Mail\WorkoutAssignedMailable;
use App\Models\Excercise;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use stdClass;

class WorkoutController extends Controller
{

    public function index(){
        $initialDate = date('Y-m-d', strtotime('monday this week'));
        $endDate = date('Y-m-d', strtotime('sunday this week'));
        
        return view('trainer.workouts.index', compact('initialDate', 'endDate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkoutRequest $request)
    {

        $draftStatus = WorkoutStatus::where('name', 'Borrador')->get();

        try{
            $newWorkout = Workout::create([
                'user_id' => Auth::user()->id,
                'owner_id' => Auth::user()->id,
                'date' => $request->date ?? date('Y-m-d'),
                'title' => $request->title,
                'status_id' => $draftStatus[0]->id
            ]);
        }catch(QueryException $e){
            Log::error('Error storing workout: ' . $e->getMessage());
            return redirect()->back();
        }

        if(isJsonRequest()){
            return response()->json([
                'message' => __('Workout created successfully'),
                'data' => $newWorkout
            ]);
        }

        return redirect()->route('workouts.edit', $newWorkout);
    }

    /**
     * Retrieves all workouts from the authenticated user
     */
    public function get($startDate = null, $endDate = null){
        $startDate = $startDate ? $startDate : date('Y-m-d', strtotime('monday this week'));
        $endDate = $endDate ? $endDate : date('Y-m-d', strtotime('sunday this week'));

        $workouts = Workout::where(function(Builder $query){
            $query->where('user_id', Auth::user()->id)
            ->orWhere('owner_id', Auth::user()->id);
        })
        ->whereBetween('date', [$startDate, $endDate])
        ->with('status', 'owner', 'user')
        ->orderBy('date', 'desc')
        ->get();


        return response()->json([
            'data' => $workouts,
            'message' => __('Workouts retrieved successfully')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {

        $this->authorize('view', $workout);
        $workoutStatuses = WorkoutStatus::all();
        $excercises = Excercise::where('public', true)->orWhere('user_id', Auth::user()->id)->get();
        $clients = [];
        if(Auth::user()->isTrainer() && false){
            $clients = Auth::user()->clients->map(function($client){
                $newClient = new stdClass();
                $newClient->id = $client->id;
                $newClient->name = $client->name;
                return $newClient;
            });
        }


        return view('workouts.edit', compact('workout', 'workoutStatuses', 'excercises', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {

        try{

            $initialWorkoutUser = $workout->user_id;
            $updateData = $request->only(['title', 'date', 'status_id', 'user_id']);
            $updateData = array_filter($updateData, function ($value) {
                return $value !== null;
            });

            $targetUser = $request->input('user_id');
            if($request->has('user_id') && $targetUser != $request->user()->id &&
                !$request->user()->clients->contains('id', $targetUser)){
                return response()->json([
                    'message' => __('An error ocurred while updating the workout')
                ], 403);
            }

            $workout->update($updateData);

        }catch(QueryException $e){
            Log::error('Error updating workout: ' . $e->getMessage());
            if(isJsonRequest()){
                return response()->json([
                    'message' => __('An error ocurred while updating the workout')
                ], 500);
            }else{
                return redirect()->route('workouts.edit', ['workout' => $workout->id]);
            }

        }

        if($workout->user_id != $initialWorkoutUser && $workout->user_id != $request->user()->id){
            $targetUser = User::find($workout->user_id);
            Mail::to($workout->user->email)
            ->send(new WorkoutAssignedMailable($targetUser, $request->user(), $workout));
        }

        if(isJsonRequest()){
            return response()->json([
                'message' => __('Workout updated successfully'),
                'data' => $workout
            ]);
        }

        return redirect()->route('workouts.edit', ['workout' => $workout->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {

        if($workout->user->id != Auth::user()->id && $workout->owner->id != Auth::user()->id){
            if(isJsonRequest()){
                return response()->json([
                    'message' => __('Unauthorized action.')
                ], 403);
            }else{
                abort(403);
            }
        }

        try{
            $workout->delete();
        }catch(QueryException $e){
            Log::error('Error deleting workout: ' . $e->getMessage());
            if(isJsonRequest()){
                return response()->json([
                    'message' => __('An error ocurred while deleting the workout')
                ], 500);
            }else{
                return redirect()->route('workouts.edit', ['workout' => $workout->id]);
            }
        }

        if(isJsonRequest()){
            return response()->json([
                'message' => __('Workout deleted successfully')
            ]);
        }

        return redirect()->route('dashboard');

    }

}
