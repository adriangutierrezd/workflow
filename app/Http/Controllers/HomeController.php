<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    public function index(Request $request){

        $role = $request->user()->role->name;

        if ($role == 'TRAINER') {
            return view('trainer.dashboard');
        } elseif ($role == 'USER') {
            return view('user.dashboard');
        } else {
            abort(403, 'Rol no reconocido.');
        }

    }

}
