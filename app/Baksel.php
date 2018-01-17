<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baksel extends Model
{

	protected $fillable = [
   		'title', 'description', 'timeSpend', 'photoName', 'bakTypeID', 'bakStatusID', 'commentStatusID'
    ];

    public function getBakselPhotoOne(){
        return Bakselphoto::where('id', $this->bakPhotosID)->first()->photoOne;
    }

    public function getBakselPhotoTwo(){
        return Bakselphoto::where('id', $this->bakPhotosID)->first()->photoTwo;
    }

    public function getBakselPhotoThree(){
        return Bakselphoto::where('id', $this->bakPhotosID)->first()->photoThree;
    }

    public function getBakselPhotoFour(){
        return Bakselphoto::where('id', $this->bakPhotosID)->first()->photoFour;
    }

    public function getBakType(){
    	return Baktype::where('id', $this->bakTypeID)->first()->type;
    }

    public function getBakStatus(){
    	return Bakstatus::where('id', $this->bakStatusID)->first()->status;
    }    
    public function getBakStatusColor(){
        return Bakstatus::where('id', $this->bakStatusID)->first()->colorCode;
    }

    public function getCommentStatus(){
    	return Commentstatus::where('id', $this->commentStatusID)->first()->status;
    }
    public function getCommentColor(){
        return Commentstatus::where('id', $this->commentStatusID)->first()->colorCode;
    }


}
