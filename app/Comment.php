<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
        public function getPostersName(){
        	return User::where('id', $this->postedBy)->first()->username;
    	}

    	public function getPosterAvatar(){
    		$profileID = User::where('id', $this->postedBy)->first()->profileID;
    		return Profile::where('id', $profileID)->first()->avatar;
    	}
}
