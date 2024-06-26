<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMailable;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    
    public function sendContactForm(Request $request){

        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        Mail::to(env('MAIL_TO_ADDRESS'))
            ->send(new ContactFormMailable($name, $email, $message));

        return redirect()->back();
    }

}
