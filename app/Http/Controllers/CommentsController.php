<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use Auth;
use File;
use Image;
use DB;
use App\User;
use App\Profile;
use App\Role;
use App\Baksel;
use App\Bakstatus;
use App\Baktype;
use App\Comment;
use App\Commentstatus;
use App\Bakselphoto;

class CommentsController extends Controller
{
	/****
	Dan word er gecontroleerd degene die het veld gepost is geen guest is of niet de role 3 (banned) heeft en geactiveerd heeft.
	Zo niet word gecontroleerd of de comment wel 6 characters of langer is.
	Als dat zo is word hij opgeslagen en de gebruiker terug gestuurt van het article met het baksel.
	Als de gebruiker wel een guest is of de role 3 (Banned) en zijn email niet geactiveerd heeft word hij naar het login scherm gestuurt.
    ****/
    public function creatingComment($id, Request $request){

    	if(!Auth::guest() || Auth::user()->roleID != 3 && Auth::user()->activated != 0){

    	$this->validate($request, [
	       'comment' => 'required|min:6'
	    ]);

	    $bakselForComment = Baksel::findOrFail($id);
		$bakselTypeID = $bakselForComment->bakTypeID;
		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

	    $newComment = new Comment;
	    $newComment->comment = $request->comment;
	    $newComment->bakselID = $id;
	    $newComment->postedBy = Auth::user()->id;
	    $newComment->created_at = Carbon::now();
	    $newComment->updated_at = Carbon::now();

	    $newComment->save();

	    switch($bakselTypeName) {
		    case "Taart":
		        return redirect()->route('showTaart', ['id' => $id]);
		        break;
		    case "Decoratie":
		        return redirect()->route('showDecoratie', ['id' => $id]);
		        break;
		    case "Cupcake":
		        return redirect()->route('showAnders', ['id' => $id]);
		        break;
		    case "Anders":
		    	return redirect()->route('showAnders', ['id' => $id]);
		    	break;
		    default:
		        return redirect('/home');
    		}
	    }else{
	    return redirect('/login');
	    }
    }

	/********************/
	/*Met het ID word de bijbehoorende comment opgehaald.
	/*Er word gecontroleerd of de ingelogde user gelijk is aan de poster en dat zijn role niet 3 (Banned is), anders error pagina 403.
	/*Of dat de ingelogde gebruiker een roleID van 2(Admin) heeft
	/*Dan word het baksel waar de comment op geplaatst is opgezocht om het BakType naam te krijgen voor de link
	/*Met behulp van de Baktype naam word de link vastgestelt en mee gestuurt naar de dynamische view
	/********************/
    public function editPost($id){
    	$commentToUpdate = Comment::findOrFail($id);

    	if($commentToUpdate->postedBy == Auth::user()->id && Auth::user()->roleID != 3 || Auth::user()->roleID == 2){

    		if(Auth::user()->activated == 0){
                return redirect('/error/403');
            }
    		
	    	$bakselID = $commentToUpdate->bakselID;
	    	$bakselForComment = Baksel::findOrFail($bakselID);
			$bakselTypeID = $bakselForComment->bakTypeID;
			$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

			$linkName;

			switch($bakselTypeName) {
			    case "Taart":
			        $linkName = "/taarten/taart";
			        break;
			    case "Decoratie":
			        $linkName = "/decoraties/decoratie";
			        break;
			    case "Cupcake":
			        $linkName = "/anderecreaties/creatie";
			        break;
			    case "Anders":
			    	$linkName = "/anderecreaties/creatie";
			    	break;
			    default:
			        return redirect('/home');
			}

	    	return view('comments/edit', array('commentToUpdate' => $commentToUpdate,
	    									   'linkName' => $linkName));
    	}else{
    		return redirect()->route('error403');
    	}
    }

	/********************/
	/*Met het ID word de comment opgehaalt die geupdate moet worden, waarmee het baksel en bakseltype word opgehaald
	/*De geupdate comment en de tijd word opgeslagen in de database en de gebruiker word terug gestuurt naar de pagina met de geupdate comment
	/********************/
	public function editingPost($id, Request $request){

		$commentToUpdate = Comment::findOrFail($id);
    	$bakselID = $commentToUpdate->bakselID;
    	$bakselForComment = Baksel::findOrFail($bakselID);
		$bakselTypeID = $bakselForComment->bakTypeID;
		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;


		$commentToUpdate->comment = $request->comment;
		$commentToUpdate->updated_at = Carbon::now();
		$commentToUpdate->save();

		 switch($bakselTypeName) {
		    case "Taart":
		        return redirect()->route('showTaart', ['id' => $bakselID]);
		        break;
		    case "Decoratie":
		        return redirect()->route('showDecoratie', ['id' => $bakselID]);
		        break;
		    case "Cupcake":
		        return redirect()->route('showAnders', ['id' => $bakselID]);
		        break;
		    case "Anders":
		    	return redirect()->route('showAnders', ['id' => $bakselID]);
		    	break;
		    default:
		        return redirect('/home');
		}

	}

	/********************/
	/*Er word gekeken of de ingelogde gebruiker de role van 2 heeft (Admin), anders error pagina 403
	/*Met het id word de comment opgehaald waarmee het baksel en bakseltype naam word opgehaald.
	/*Met behulp van het bakseltypenaam word de link bepaald en meegestuurt naar de dynamische view 
	/********************/
	public function deletePost($id){

		if(Auth::user()->roleID == 2){
			$commentToDelete = Comment::findOrFail($id);
	    	$bakselID = $commentToDelete->bakselID;
	    	$bakselForComment = Baksel::findOrFail($bakselID);
			$bakselTypeID = $bakselForComment->bakTypeID;
			$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

			$linkName;

			switch($bakselTypeName) {
			    case "Taart":
			        $linkName = "/taarten/taart";
			        break;
			    case "Decoratie":
			        $linkName = "/decoraties/decoratie";
			        break;
			    case "Cupcake":
			        $linkName = "/anderecreaties/creatie";
			        break;
			    case "Anders":
			    	$linkName = "/anderecreaties/creatie";
			    	break;
			    default:
			        return redirect('/home');
			}

	    	return view('comments/delete', array('commentToDelete' => $commentToDelete,
	    									     'linkName' => $linkName,
	    									     'bakselID' => $bakselID));
		}else{
			return redirect()->route('error403');
		}
    
	}

	/********************/
	/*Met het id word de comment opgehaald waarmee het baksel en bakseltype naam word opgehaald.
	/*De bijbehoorende comment word gedelete.
	/*Met behulp van het bakseltypenaam word de link bepaald en de gebruiker word terug gestuurt naar de pagina waar de comment gedelete is
	/********************/
	public function deletingPost($id, Request $request){

		$commentToDelete = Comment::findOrFail($id);
    	$bakselID = $commentToDelete->bakselID;
    	$bakselForComment = Baksel::findOrFail($bakselID);
		$bakselTypeID = $bakselForComment->bakTypeID;
		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

		$commentToDelete->delete();

		switch($bakselTypeName) {
		    case "Taart":
		        return redirect()->route('showTaart', ['id' => $bakselID]);
		        break;
		    case "Decoratie":
		        return redirect()->route('showDecoratie', ['id' => $bakselID]);
		        break;
		    case "Cupcake":
		        return redirect()->route('showAnders', ['id' => $bakselID]);
		        break;
		    case "Anders":
		    	return redirect()->route('showAnders', ['id' => $bakselID]);
		    	break;
		    default:
		        return redirect('/home');
		}
	}


	/********************/
	/*2.7*/
	/*Haalt alle comments op met het de gelijke bakselID
	/*Een variable count met -1 (Want een array begint op 0, voor testen)
	/*Haalt de gebruikers username & avatar op om te laten zien bij de comment
	/*Zet alle benodigde informatie in een tijdelijke array om hem in de commentsArray to pushe
	/*Deze array word json_encode op gebruikt en een object van gemaakt, waarna hij gereturned word.
	/********************/

	public function getAllComments($id){

		$bakselID = $id;
		$comments = Comment::where('bakselID', '=', $bakselID)->orderBy("created_at", "desc")->get();

		$allComments = $comments;
		$commentsArray = array();

		$count = -1;
		foreach($allComments as $comment){
			$count++;

			$profileID = User::where('id', $comment->postedBy)->first()->profileID;
			$posterName = User::where('id', $comment->postedBy)->first()->username;
    		$posterAvatar =  Profile::where('id', $profileID)->first()->avatar;

			$commentArray = array(
				'id' => $comment->id,
				'comment' => $comment->comment,
				'bakselID' => $comment->bakselID,
				'postedBy' => $comment->postedBy,
				'created_at' => $comment->created_at,
				'updated_at' => $comment->updated_at,
				'avatar' => $posterAvatar,
				'posterName' => $posterName
				);

			array_push($commentsArray, $commentArray);
		}

		$jsonObject = json_encode($commentsArray, JSON_FORCE_OBJECT);

		return $commentsArray;
	}
}
