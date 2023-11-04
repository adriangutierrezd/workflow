<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutRequest;
use App\Http\Requests\UpdateWorkoutRequest;
use App\Models\Workout;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkoutStatus;
use Illuminate\Database\QueryException;
use App\Models\Excercise;

class WorkoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
            return redirect()->back();
        }

        if(isJsonRequest()){
            return response()->json([
                'message' => 'Workout created successfully',
                'workout' => $newWorkout
            ]);
        }

        return redirect()->route('workouts.edit', $newWorkout);
    }

    public function get(){
        $workouts = Workout::where('user_id', Auth::user()->id)->with('status')->get();

        return response()->json([
            'data' => $workouts,
            'msg' => 'Workouts retrieved successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {

        $workoutStatuses = WorkoutStatus::all();
        $excercises = Excercise::all();

        return view('workouts.edit', compact('workout', 'workoutStatuses', 'excercises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkoutRequest $request, Workout $workout)
    {
        
        try{

            $updateData = [
                'title' => $request->title
            ];

            if($request->date){
                $updateData['date'] = $request->date;
            }

            if($request->status_id){
                $updateData['status_id'] = $request->status_id;
            }

            $workout->update($updateData);

        }catch(QueryException $e){
            if(isJsonRequest()){
                return response()->json([
                    'message' => 'An error ocurred while updating the workout'
                ], 500);
            }else{
                return redirect()->route('workouts.edit', ['workout' => $workout->id]);
            }

        }

        if(isJsonRequest()){
            return response()->json([
                'message' => 'Workout updated successfully'
            ]);
        }

        return redirect()->route('workouts.edit', ['workout' => $workout->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {

        try{
            $workout->delete();
        }catch(QueryException $e){
            if(isJsonRequest()){
                return response()->json([
                    'message' => 'An error ocurred while deleting the workout'
                ], 500);
            }else{
                return redirect()->route('workouts.edit', ['workout' => $workout->id]);
            }
        }

        if(isJsonRequest()){
            return response()->json([
                'message' => 'Workout deleted successfully'
            ]);
        }

        return redirect()->route('dashboard');

    }
}
