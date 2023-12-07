<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTrainerRequestRequest;
use App\Mail\UserTrainerRequestMailable;
use App\Models\TrainerUser;
use App\Models\User;
use App\Models\UserTrainerRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
        ->where('trainer_id', $request->input('trainer_id'))
        ->where('accepted', 0)->get();

        if($userTrainerRequests->isNotEmpty()){

            $nonExpiredRequests = $userTrainerRequests->filter(function($request){
                return !$request->isExpired();
            });

            if($nonExpiredRequests->isNotEmpty()){
                return redirect()->back()->with('banner', [
                    'type' => 'error',
                    'message' => __('Wait for your previous application to be accepted or to expire')
                ]);
            }
        }

        if($request->user()->trainer){
            return redirect()->back()->with('banner', [
                'type' => 'error',
                'message' => __('Terminate your relationship with your current trainer to apply for a new one.')
            ]);
        }

        try{
            $userTrainerRequest = UserTrainerRequest::create([
                'user_id' => Auth::user()->id,
                'trainer_id' => $request->input('trainer_id'),
                'token' => Str::uuid(),
                'message' => $request->input('message') ?? null,
                'token_expires_at' => now()->addHours(UserTrainerRequest::TTL_HOURS)
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


    public function accept(Request $request, string $token)
    {

        $userTrainerRequest = UserTrainerRequest::where('token', $token)->first();

        if(!$userTrainerRequest){
            abort(404, "CUSTOM_MESSAGE: ".__('Application not found'));
        }

        if($userTrainerRequest->trainer_id != $request->user()->id){
            abort(403);
        }

        $trainerUser = User::find($userTrainerRequest->trainer_id);
        if(!$trainerUser->isTrainer()){
            abort(403);
        }

        if($userTrainerRequest->accepted){
            abort(403, "CUSTOM_MESSAGE: ".__('This application is already accepted'));
        }

        if($userTrainerRequest->isExpired()){
            abort(404, "CUSTOM_MESSAGE: ".__('This application has expired'));
        }

        $trainerUserRelation = TrainerUser::where('user_id', $userTrainerRequest->user_id)->get();
        if($trainerUserRelation->isNotEmpty()){
            abort(403, "CUSTOM_MESSAGE: ".__('This user already has a trainer'));
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


}
