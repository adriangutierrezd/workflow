<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorkoutStatusRequest;
use App\Http\Requests\UpdateWorkoutStatusRequest;
use App\Models\WorkoutStatus;

class WorkoutStatusController extends Controller
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
    public function store(StoreWorkoutStatusRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkoutStatus $workoutStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkoutStatus $workoutStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkoutStatusRequest $request, WorkoutStatus $workoutStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkoutStatus $workoutStatus)
    {
        //
    }
}
