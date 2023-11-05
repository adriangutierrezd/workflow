<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClusterRequest;
use App\Http\Requests\UpdateClusterRequest;
use App\Models\Cluster;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Models\Workout;

class ClusterController extends Controller
{


    public function getByWorkout(Workout $workout)
    {
        $clusters = Cluster::where('workout_id', $workout->id)->with('excercise')->get();

        return response()->json([
            'message' => 'Clusters fetched successfully',
            'clusters' => $clusters
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClusterRequest $request)
    {
        try{
            $newClustrer = Cluster::create([
                'user_id' => $request->user_id ?? Auth::user()->id,
                'owner_id' => Auth::user()->id,
                'workout_id' => $request->workout_id,
                'excercise_id' => $request->excercise_id,
                'reps' => $request->reps,
                'sets' => $request->sets,
                'weight' => $request->weight,
                'done' => $request->done ?? false,
                'unit' => $request->units ?? 'kg'
            ]);
        }catch(QueryException $e){
            dd($e);
            return redirect()->back();
        }

        if(isJsonRequest()){
            return response()->json([
                'message' => 'Cluster created successfully',
                'cluster' => $newClustrer
            ], 201);
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClusterRequest $request, Cluster $cluster)
    {
        try{

            $clusterUpdate = [
                'user_id' => $request->user_id ?? $cluster->user_id,
                'workout_id' => $request->workout_id ?? $cluster->workout_id,
                'excercise_id' => $request->excercise_id ?? $cluster->excercise_id,
                'reps' => $request->reps ?? $cluster->reps,
                'sets' => $request->sets ?? $cluster->sets,
                'weight' => $request->weight ?? $cluster->weight,
                'done' => $request->done ?? $cluster->done,
                'unit' => $request->units ?? $cluster->unit
            ];

            $cluster->update($clusterUpdate);

        }catch(QueryException $e){
            return response()->json([
                'message' => 'An error ocurred while updating the cluster'
            ], 500);
        }

        return response()->json([
            'message' => 'Cluster updated successfully',
            'cluster' => $cluster
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cluster $cluster)
    {
        
        try{
            $cluster->delete();
        }catch(QueryException $e){
            return response()->json([
                'message' => 'An error ocurred while deleting the cluster'
            ], 500);
        }

        return response()->json([
            'message' => 'Workout deleted successfully'
        ]);

    }
}
