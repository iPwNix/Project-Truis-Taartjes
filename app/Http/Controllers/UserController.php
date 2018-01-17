<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use Carbon\Carbon;


use Auth;
use File;
use Image;
//use Intervention\Image\Image;
//use /vendor/intervention/image/src/Intervention/Image/Image.php

use App\User;
use App\Profile;
use App\Role;

class UserController extends Controller
{
    /********************/
    /*Er word gekeken of de genene die bij het profiel probeert te komen wel ingelogd is.
    /*Dan word de user met al zijn data opgehaald, mocht dat niet lukken word de 404 pagina laten zien
    /********************/
    public function showProfile($id){
      if (Auth::check()) 
	     {
	     	try{
	     		$user = User::findOrFail($id);
	     		$profile = Profile::findOrFail($user->profileID);
	     		$role = Role::findOrFail($user->roleID);
	     		return view("users/showProfile", array('user' => $user, 
	     											   'profile' => $profile,
	     											   'role' => $role));
	     	}
	     	catch(\Exception $e){
					    return redirect('/error/404');
					}
	     }else{
	     	return redirect('/login')->withErrors('Please Login or Register first');
	     }
    }

/********************/
/*De gegevens van de gebruiker worden opgehaald en mee gestuurt naar de editMain form
/********************/
    public function editProfileMain($id){
    	if(Auth::user()->id == $id || Auth::user()->roleID == 2){
            if(Auth::user()->activated == 0){
                return redirect('/error/403');
            }
    			$user = User::findOrFail($id);
	     		$profile = Profile::findOrFail($user->profileID);
	     		$role = Role::findOrFail($user->roleID);

	     		return view("users/edit/editMain", array('user' => $user, 
	     											     'profile' => $profile,
	     											     'role' => $role));
    	}else{
            return redirect('/error/403');
        }
    }


    /**** Hier kan de gebruiker zijn echte naam aanpassen als hij dit wilt, voor stel dat hij een typ fout bij registratie heeft gemaakt, ook kan hier de avatar aangepast worden die gelijk geresized word naar 300x300px ****/
    public function updateProfileMain($id, Request $request){
    	if(Auth::check()){
    		if(Auth::user()->id == $id || Auth::user()->roleID == 2){
    		$this->validate($request, [
            'avatar' => 'image|mimes:jpg,jpeg,png|max:3072',
    		]);

    		$user = User::findOrFail($id);
    		$profileToUpdate = Profile::findOrFail($user->profileID);



			//Als $request avatar bevat (kan ook dat je aleen je naam wilt veranderen)
			if($request->hasFile('avatar'))
			{
				//Zet de file in een variable
				$avatar = $request->file('avatar');
				//Genereert een filenaam met behulp van de username & tijd, tegelijkertijd word er een jpg van gemaakt
			    $filename = $user->username . time() . "." . "jpg";
			    //Resized de avatar naar 300x300 pixels en upload hem naar 
			    //(public/uploads/avatars/{{FILENAME}})
				Image::make($avatar)->fit(300,300)
				->save(public_path("/uploads/avatars/" . $filename ));
				//Als de avatar die de gebruiker nu heeft niet de standaard avatar is
				if ($profileToUpdate->avatar != "defaultAvatar.jpg") 
				{
					 //Het pad naar de avatars upload folder en de oude avatar naam
		             $path = '/uploads/avatars/';
		             $currentAvatarName = $profileToUpdate->avatar;
		             //combineerd de $path en $currentAvatarName en delete de file
		             File::Delete(public_path( $path . $currentAvatarName) );
		 
		        }
		        	//Slaat de filename op in het te update profiel
		    		$profileToUpdate->avatar = $filename;
		 
			}

    		$profileToUpdate->updated_at = Carbon::now();
    		$profileToUpdate->save();

    		return redirect()->route('showProfile', ['id' => $id]);
    	 }else{
    	 	return redirect('/error/403');
    	 }
    	}else{
    		return redirect('/login')->withErrors('Please Login or Register first');
		}
    }

    /****  Een admin kan de informatie van de gebruiker bijwerken als dat nodig is****/
    public function editUserInfo($id){
    	if(Auth::user()->roleID == 2){
    		   	$user = User::findOrFail($id);
    			$profile = Profile::findOrFail($user->profileID);

    			$roles = Role::all();
				return view("users/edit/editInfo", array('user' => $user,
														 'profile' => $profile,
														 'roles' => $roles));
    	}else{
    		return redirect('/error/403');
    	}
    }

    /********************/
    /*De user zijn gegevens worden opgehaald en ook zijn profiel
    /*Ook alle andere gebruikers worden opgehaald om over heen te loopen om te kijken of de email die bijgewerkt word mischien al bestaat.
    /*Daarna word alles opgeslagen in de database en de gebruiker word terug gestuurt naar het geedite profiel
    /********************/
    public function updateUserInfo($id, Request $request){    		
        if(Auth::user()->roleID == 2){
    		$user = User::findOrFail($id);
            $profileToUpdate = Profile::findOrFail($user->profileID);
    		$allUsers = User::all();

    	   	$this->validate($request, [
            'realName' => 'required|min:1|max:191',
        	'username' => 'required|min:1|max:191|unique:users,username,'.$user->id,
        	'email' => 'required|email|min:6|max:191|unique:users,email,'.$user->id,
        	'role' => 'required|min:1'
    		]);


            
    		foreach($allUsers as $oneUser){
    			if($oneUser->email == $request->email && $oneUser->id != $id){
    				return Redirect::back()->withErrors(['emailError' => 'Email is al bezet door een andere gebruiker.']);
    			}
    		}

            //Integrity constraint violation: 1062 Duplicate entry voorkomen
            if($user->email != $request->email){
                $user->email = $request->email;
            }

            if($user->username != $request->username)
            {
                $user->username = $request->username;
            }

            $profileToUpdate->realName = $request->realName;
    		$user->roleID = $request->role;

            $profileToUpdate->save();
    		$user->save();

    		return redirect()->route('showProfile', ['id' => $id]);
        }else{
            return redirect('/error/403');
        }
    }

    /***************************************************************************************  
    	   De gebruiker kan zijn wachtwoord veranderen mocht hij dat willen 
    	   Als een gebruiker zijn wachtwoord is vergeten word er een random wachtwoord gegenereerd en gemailed waarmee hij kan inloggen en hier weer zijn wachtwoord kan verranderen 
   	***************************************************************************************/
    public function editUserPass($id){
    	if(Auth::user()->id == $id && Auth::user()->roleID != 3 || Auth::user()->roleID == 2){
            if(Auth::user()->activated == 0){
                return redirect('/error/403');
            }
    		   	$user = User::findOrFail($id);
    			$profile = Profile::findOrFail($user->profileID);
				return view("users/edit/editPass", array('user' => $user,
														 'profile' => $profile));
    	}else{
    		return redirect('/error/403');
    	}
    }

    /********************/
    /*De gebruiker word opgehaald.
    /*Het wachtwoord dat hij ingevult heeft word gehashed en opgeslagen in de database
    /********************/
    public function updateUserPass($id, Request $request){
    	if(Auth::user()->id == $id || Auth::user()->roleID == 2){
    	    $this->validate($request, [
        	'password' => 'required|min:6|confirmed'
    		]);

    		$userToUpdate = User::findOrFail($id);
    	    $newPassword = bcrypt($request->password);

    	    $userToUpdate->password = $newPassword;
    	    $userToUpdate->updated_at = Carbon::now();
    	    $userToUpdate->save();

    	    return redirect()->route('showProfile', ['id' => $id]);
    	}else{
    		return redirect('/error/403');
    	}
    }



}
