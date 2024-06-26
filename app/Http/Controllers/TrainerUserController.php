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

        $trainerUserRelation = TrainerUser::where('user_id', Auth::user()->id)->first();

        $trainerRole = Role::where('name', 'TRAINER')->first();
        $trainers = User::where('role_id', $trainerRole->id)
        ->when($trainerUserRelation, function ($query) use ($trainerUserRelation) {
            $query->where('id', '!=', $trainerUserRelation->trainer_id);
        })
        ->get();
        
        return view('trainer.index', compact('trainers', 'trainerUserRelation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrainerUserRequest $request)
    {

        $trainerUser = User::find($request->trainer_id);
        if(!$trainerUser->isTrainer()){
            return response()->json([
                'message' => __('Error creating relationship'),
                'data' => null
            ], 403);
        }

        try{
            TrainerUser::create([
                'user_id' => $request->user_id ?? auth()->user()->id,
                'trainer_id' => $request->trainer_id
            ]);
        }catch(QueryException $e){
            Log::error('Error storing trainer user relation: ' . $e->getMessage());
            return response()->json([
                'message' => __('Error creating relationship'),
                'data' => null
            ], 500);
        }

        return response()->json([
            'message' => __('Relationship created successfully'),
            'data' => null
        ], 201);
        
    }

    /**
     * Retrieves all clients from the authenticated trainer
     */
    public function getClientsByTrainer(Request $request, User $user){

        if($request->user()->cannot('retrieve', [TrainerUser::class, $user])){
            return response()->json([
                'message' => __('Unauthorized action.'),
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
                'message' => __('Unauthorized action.'),
                'data' => null
            ], 401);
        }

        try{
            $trainerUser->delete();
        }catch(QueryException $e){
            Log::error('Error deleting trainer user relation: ' . $e->getMessage());
            return response()->json([
                'message' => __('An error ocurred'),
                'data' => null
            ], 500);
        }

        return response()->json([
            'message' => __('Resource successfully removed'),
            'data' => null
        ]);
    }

    public function getPossibleClients(Request $request, $search = null){

        if($request->user()->cannot('getPossibleClients', [TrainerUser::class])){
            return response()->json([
                'message' => __('Unauthorized action.'),
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
            'message' => __('Data successfully obtained'),
            'data' => $possibleClients
        ]);

    }

}
