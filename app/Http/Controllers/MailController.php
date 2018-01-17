<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;

class MailController extends Controller
{
    public function send(Request $request){
        $title = $request->input('title');
        $content = $request->input('content');

        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message)
        {
            $message->from('TruisTaartjes@gmail.com', 'Christian Nwamba');
            $message->to('erik_vlasblom@hotmail.com');
        });

        return response()->json(['message' => 'Request completed']);       
	}

	public function welcome(){
		    $data = array(
        	'name' => Auth::user()->name,
		    );

		    Mail::send('emails.welcome', $data, function ($message) {
		        $message->from('no-reply@Truistaartjes.nl', 'Truis Taartjes');
		        $message->to('TruisTaartjes@gmail.com')->subject('Welkom!');

		    });

		    return "Your email has been sent successfully";
	}
}
