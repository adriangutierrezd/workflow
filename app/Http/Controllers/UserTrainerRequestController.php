<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTrainerRequestRequest;
use App\Mail\UserTrainerRequestMailable;
use App\Models\TrainerUser;
use App\Models\UserTrainerRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserTrainerRequestController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserTrainerRequestRequest $request)
    {

        $userTrainerRequests = UserTrainerRequest::where('user_id', $request->user()->id)
        ->where('accepted', 0)->get();

        if($userTrainerRequests->isNotEmpty()){
            return redirect()->back()->with('banner', [
                'type' => 'error',
                'message' => __('Wait for your previous application to be accepted or to expire')
            ]);
        }

        try{
            $userTrainerRequest = UserTrainerRequest::create([
                'user_id' => Auth::user()->id,
                'trainer_id' => $request->input('trainer_id'),
                'token' => Str::uuid(),
                'message' => $request->input('message') ?? null,
                'token_expires_at' => now()->addHours(2)
            ]);

            Mail::to($userTrainerRequest->trainer->email)
            ->send(new UserTrainerRequestMailable($userTrainerRequest));

        }catch(QueryException $e){
            Log::error('Error storing StoreUserTrainerRequest: ' . $e->getMessage());
            return redirect()->back();
        }

        return redirect()->back()->with('banner', [
            'type' => 'success',
            'message' => __('Request sent')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function accept(string $token)
    {

        $userTrainerRequest = UserTrainerRequest::where('token', $token)->first();

        if(!$userTrainerRequest){
            abort(404, __('Application not found'));
        }

        if($userTrainerRequest->accepted){
            abort(403, __('This application is already accepted'));
        }

        if($userTrainerRequest->isExpired()){
            abort(404, __('This application has expired'));
        }

        $userTrainerRequest->update([
            'accepted' => true
        ]);

        TrainerUser::create([
            'user_id' => $userTrainerRequest->user_id,
            'trainer_id' => $userTrainerRequest->trainer_id
        ]);


        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserTrainerRequest $userTrainerRequest)
    {
        //
    }
}
