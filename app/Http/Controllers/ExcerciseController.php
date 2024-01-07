<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExcerciseRequest;
use App\Http\Requests\UpdateExcerciseRequest;
use App\Models\Excercise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ExcerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('excercises.index', ['targetUser' => Auth::user()]);
    }

    public function get(){
        $excercises = Excercise::where('public', true)
        ->orWhere('user_id', Auth::user()->id)
        ->with('user')->get();

        return response()->json([
            'excercises' => $excercises,
            'message' => __('Data successfully obtained')
        ]);
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
    public function store(StoreExcerciseRequest $request)
    {

        try{
            $excercise = Excercise::create([
                'name' => $request->name,
                'user_id' => Auth::user()->id
            ]);
        }catch(QueryException $e){
            Log::error('Error storing excercise: ' . $e->getMessage());
            return redirect()->back();
        }
        
        return response()->json([
            'message' => __('Excercise created successfully'),
            'data' => $excercise
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Excercise $excercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Excercise $excercise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExcerciseRequest $request, Excercise $excercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Excercise $excercise)
    {
        if($excercise->user_id != Auth::user()->id){
            if(isJsonRequest()){
                return response()->json([
                    'message' => __('Unauthorized action.')
                ], 403);
            }else{
                abort(403);
            }
        }

        try{
            $excercise->delete();
        }catch(QueryException $e){
            Log::error('Error deleting excercise: ' . $e->getMessage());
            if(isJsonRequest()){
                return response()->json([
                    'message' => __('An error ocurred while deleting the excercise')
                ], 500);
            }else{
                return redirect()->route('excercises.index');
            }
        }

        if(isJsonRequest()){
            return response()->json([
                'message' => __('Excercise deleted successfully')
            ]);
        }

        return redirect()->route('excercises.index');
    }
}
