<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTrainerUserRequest;
use App\Models\Role;
use App\Models\TrainerUser;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TrainerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if($request->user()->cannot('view', [TrainerUser::class])){
            abort(403);
        }

        return view('trainer.clients');
    }


    public function trainersIndex()
    {

        if(Auth::user()->isTrainer()){
            abort(403);
        }

        $trainerRole = Role::where('name', 'TRAINER')->first();
        $trainers = User::where('role_id', $trainerRole->id)->get();
        
        return view('trainer.index', compact('trainers'));
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
        ], 201);
        
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

        $clients = TrainerUser::where('trainer_id', $user->id)->with('clients')->get();
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

    public function getPossibleClients(Request $request, $search = null){

        if($request->user()->cannot('getPossibleClients', [TrainerUser::class])){
            return response()->json([
                'message' => 'Unauthorized',
                'data' => null
            ], 401);
        }

        $trainerUsers = TrainerUser::all();
        $trainerUsersIds = $trainerUsers->pluck('user_id');
        $trainerUsersIds[] = $request->user()->id;
        $possibleClients = User::whereRelation('role', 'name', 'USER')
            ->whereNotIn('id', $trainerUsersIds)
            ->where('name', 'like', '%' . $search . '%')
            ->select('id', 'name')
            ->get();


        return response()->json([
            'message' => 'Possible clients retrieved successfully',
            'data' => $possibleClients
        ]);

    }

}
