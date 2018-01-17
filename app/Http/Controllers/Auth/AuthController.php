<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Useractivation;
use Request;
use Mail;

use Carbon\Carbon;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:25|unique:users',
            'name' => 'required|max:75',
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required|min:6|confirmed',
            //'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $newUserMail = $data['email'];
        $newUsername = $data['username'];


        $newProfile = new Profile;
        $newProfile->realName = $data['name'];
        $newProfile->avatar = 'defaultAvatar.jpg';
        $newProfile->created_at = Carbon::now();
        $newProfile->updated_at = Carbon::now();
        $newProfile->save();

        $userIP = Request::ip();

        $newUser = new User;
        $newUser->username = $data['username'];
        $newUser->email = $data['email'];
        $newUser->password = bcrypt($data['password']);
        $newUser->userIP = $userIP;
        $newUser->activated = false;
        $newUser->profileID = $newProfile->id;
        $newUser->roleID = 1;
        $newUser->created_at = Carbon::now();
        $newUser->updated_at = Carbon::now();
        $newUser->save();

        $newUserActivation = new Useractivation;
        $newUserActivation->userID = $newUser->id;

        $activateToken = str_random(30);
        $newUserActivation->token = $activateToken;

        $newUserActivation->created_at = Carbon::now();
        $newUserActivation->save();


            $data = array( 'email' => $newUserMail, 
                           'username' => $newUsername,
                           'from' => 'no-reply@Truistaartjes.nl', 
                           'from_name' => 'Truis Taartjes',
                           'activateToken' => $activateToken);

            Mail::send( 'emails.welcome', $data, function( $message ) use ($data)
            {
                $message->to( $data['email'] )->from( $data['from'], $data['from_name'] )->subject( 'Welcome!' );
            });




        return $newUser;
    }
}
