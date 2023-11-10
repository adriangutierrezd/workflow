<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainerUserRequest;
use App\Models\TrainerUser;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Http\Request;

class TrainerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('trainer.clients');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainerUserRequest $request)
    {

        try{
            TrainerUser::create([
                'user_id' => $request->user_id ?? auth()->user()->id,
                'trainer_id' => $request->trainer_id
            ]);
        }catch(QueryException $e){
            Log::error('Error storing trainer user relation: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error creating relationship',
                'data' => null
            ], 500);
        }

        return response()->json([
            'message' => 'Relationship created successfully',
            'data' => null
        ]);
        
    }

    /**
     * Retrieves all clients from the authenticated trainer
     */
    public function getClientsByTrainer(Request $request, User $user){

        if($request->user()->cannot('retrieve', [TrainerUser::class, $user])){
            return response()->json([
                'message' => 'Unauthorized',
                'data' => null
            ], 401);
        }

        $clients = TrainerUser::where('trainer_id', $user->id)->get();
        return response()->json([
            'message' => 'Clients retrieved successfully',
            'data' => $clients
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, TrainerUser $trainerUser)
    {

        if($request->user()->cannot('destroy', [TrainerUser::class, $trainerUser])){
            return response()->json([
                'message' => 'Unauthorized',
                'data' => null
            ], 401);
        }

        try{
            $trainerUser->delete();
        }catch(QueryException $e){
            Log::error('Error deleting trainer user relation: ' . $e->getMessage());
            return response()->json([
                'message' => 'Error deleting relationship',
                'data' => null
            ], 500);
        }

        return response()->json([
            'message' => 'Relationship deleted successfully',
            'data' => null
        ]);
    }

}
