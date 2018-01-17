<?php

namespace App\Http\Controllers;

use Session;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Useractivation;

use App\Http\Requests;

class ActiveUserController extends Controller
{

	/********************/
	/* Als de gebruiker ingelogd is word hij uitgelogd.
	/* Waarna er met zijn token gezocht word naar de gebruiker,
	/* en zijn activated status naar true word gezet en zijn token gedelete.
	/* Als de token niet bestaat word de gebruiker geredirect met een error.
	/********************/
    public function activateUser($token){

    	if(!Auth::guest())
    	{
    		Auth::logout();
    	}

    	$DBToken = Useractivation::where('token', '=', $token)->first();
    	if($DBToken !== NULL){
			$user = User::findOrFail($DBToken->userID);
			$user->activated = true;
			$user->save();

			$DBToken->delete();
			Session::flash('activationMessage', 'Uw account is nu geactiveerd!'); 

			return redirect('/login');

    	}else{
    		Session::flash('activationErrorMessage', 'Link bestaat niet meer, registeer een nieuw account of login op uw bestaande.'); 

			return redirect('/register');
    	}


    }
}
