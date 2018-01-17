<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

use Session;
use Auth;
use Mail;

class PasswordResetController extends Controller
{
    public function index(){
    	return view('users/passReset');
    }

	public function sendingMail(Request $request){
		$validator = $this->validate($request, [
        	'email' => 'required|min:6|max:191|email'
    	]);

		$userMail = $request->email;
		$userToChange = User::where('email', '=', $userMail)->first();

		if($userToChange){
			$userEmail = $userToChange->email;
			$userName = $userToChange->username;

			//echo $userMail." found changing password";

			$randomPass = str_random(8);
			$randomCrypt = bcrypt($randomPass);
 
			$userToChange->password = $randomCrypt;
			$userToChange->save();

		    $data = array( 'email' => $userEmail, 
                           'username' => $userName,
                           'from' => 'no-reply@Truistaartjes.nl', 
                           'from_name' => 'Truis Taartjes',
                           'newPass' => $randomPass);


            Mail::send( 'emails.resetPass', $data, function( $message ) use ($data)
            {
                $message->to( $data['email'] )->from( $data['from'], $data['from_name'] )->subject( 'Wachtwoord Reset' );
            });

            Session::flash('passResetMsg', 'Uw nieuwe wachtwoord is opgestuurt!'); 

		    return redirect("/login");

			}else{
			 	Session::flash('passResetErrorMsg', 'Email bestaat niet!');
			 	return redirect()->back()->withInput();
			}
	}
}
