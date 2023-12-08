<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClusterRequest;
use App\Http\Requests\UpdateClusterRequest;
use App\Models\Cluster;
use App\Models\Workout;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClusterController extends Controller
{


    public function getByWorkout(Workout $workout)
    {
        $clusters = Cluster::where('workout_id', $workout->id)->with('excercise')->get();

        return response()->json([
            'message' => __('Data successfully obtained'),
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
            Log::error('Error storing cluster: ' . $e->getMessage());
            return redirect()->back();
        }

        if(isJsonRequest()){
            return response()->json([
                'message' => __('Resource successfully created'),
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
            Log::error('Error updating cluster: ' . $e->getMessage());
            return response()->json([
                'message' => __('An error ocurred')
            ], 500);
        }

        return response()->json([
            'message' => __('Successfully updated resource'),
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
            Log::error('Error deleting cluster: ' . $e->getMessage());
            return response()->json([
                'message' => __('An error ocurred')
            ], 500);
        }

        return response()->json([
            'message' => __('Resource successfully removed')
        ]);

    }
}
