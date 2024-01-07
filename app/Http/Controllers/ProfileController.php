<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {


        return view('profile.edit', [
            'user' => $request->user()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $validator = Validator::make($request->all(), [
            'role_id' => 'exists:roles,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors(['role_id' => __('The selected role is invalid')]);
        }

        $targetRole = Role::find($request->input('role_id'));
        if($targetRole->name != 'TRAINER' && Auth::user()->clients->isNotEmpty()){
            return redirect()->back()->withInput()->withErrors(
                ['role_id' => __("You can't change roles, you still have assigned customers")]
            );
        }elseif($targetRole->name != 'USER' && Auth::user()->trainer){
            return redirect()->back()->withInput()->withErrors(
                ['role_id' => __("You cannot change roles, you still have an assigned trainer.")]
            );
        }

        $request->user()->role_id = $request->input('role_id');

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if($request->hasFile('photo_path')){
            $file = $request->file('photo_path');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/app/public'), $filename);
            $request->user()->photo_path = $filename;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
