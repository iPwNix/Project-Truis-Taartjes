<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use Auth;
use File;
use Image;
use DB;
use Storage;
use App\User;
use App\Profile;
use App\Role;
use App\Baksel;
use App\Bakstatus;
use App\Baktype;
use App\Comment;
use App\Commentstatus;
use App\Bakselphoto;

class BakselsController extends Controller
{
	/********************/
	/*Haalt alle Baktypes en de statusen van Baksel en comments op deze informatie is nodig in het form.
	/*Stuurt alle data mee naar de Bakselcreate view.
	/********************/
    public function createPost(){
		$bakTypes = Baktype::all();
		$bakStatuses = Bakstatus::all();
		$commentStatuses = Commentstatus::all();
		
		return view('baksels/bakselpost/create', array('bakTypes' => $bakTypes,
											   		   'bakStatuses' => $bakStatuses,
											   		   'commentStatuses' => $commentStatuses));
	}

	/********************/
	/*Krijgt het post request binnen en controleerd of alles klopt met de validation
	/*Vanuit het request word er gekeken wat voor baktype er gepost word
	/*Kijkt welke fotos er zijn geupload en genereerd met behulp van de tijd een naam voor de foto.
	/*Daarna word de foto geresized naar 1920x1080x en geupload, de filenaam word ook bewaard.
	/*Waarna alles word opgeslagen in de database
	/*Met behulp van het baktypeID word er gekeken waarnaar de gebruiker terug gestuurt moet worden
	/*De gebruiker word naar het nieuwe artikel gestuurt die hij net gepost heeft
	/********************/
	public function creatingPost(Request $request){

		$this->validate($request, [
        'title' => 'required|min:1|max:75',
        'bakType' => 'required|min:1|max:1',
        'bakStatus' => 'required|min:1|max:1',
        'commentStatus' => 'required|min:1|max:1',
        'timeSpend' => 'max:75',
        'description' => 'required',
        'photoOne' => 'image|mimes:jpg,jpeg,png|max:10240',
		'photoTwo' => 'image|mimes:jpg,jpeg,png|max:10240',
		'photoThree' => 'image|mimes:jpg,jpeg,png|max:10240',
		'photoFour' => 'image|mimes:jpg,jpeg,png|max:10240'
    	]);

		ini_set('memory_limit','2048M');

		$bakselTypeID = $request->bakType;

		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

	    $newBakselPhoto = new Bakselphoto;

	    //Als request photoOne file heeft
    	if($request->hasFile('photoOne')){
    		//Slaat de file op in het variable
			$photoOne = $request->file('photoOne');
			//Genereert een naam met behulp van de time+1 (Zodat alle fotos een andere naam krijgen).
			//En convert de foto ook gelijk naar een jpg
			$photoOneName = time()+1 . "." . "jpg";
			//De file (Foto) word geresized naar 1920x1080 en opgeslagen in
			//(public/uploads/baksels/{{BakselTypeNaam}}/{{Fotonaam}})
			Image::make($photoOne)->fit(1920,1080)
				->save(public_path("/uploads/baksels/".$bakselTypeName."/".$photoOneName));
			//Zet de foto naam in het te maken Bakselphoto object om op te slaan in de database
		    $newBakselPhoto->photoOne = $photoOneName;
		}

		if($request->hasFile('photoTwo')){

			$photoTwo = $request->file('photoTwo');
			$photoTwoName = time()+2 . "." . "jpg";
			    
			Image::make($photoTwo)->fit(1920,1080)
				->save(public_path("/uploads/baksels/".$bakselTypeName."/".$photoTwoName));

		    $newBakselPhoto->photoTwo = $photoTwoName;
		}

		if($request->hasFile('photoThree')){

			$photoThree = $request->file('photoThree');
			$photoThreeName = time()+3 . "." . "jpg";
			    
			Image::make($photoThree)->fit(1920,1080)
				->save(public_path("/uploads/baksels/".$bakselTypeName."/".$photoThreeName));

			$newBakselPhoto->photoThree = $photoThreeName;
		}

		if($request->hasFile('photoFour')){

			$photoFour = $request->file('photoFour');
			$photoFourName = time()+4 . "." . "jpg";
			    
			Image::make($photoFour)->fit(1920,1080)
				->save(public_path("/uploads/baksels/".$bakselTypeName."/".$photoFourName));
 
		    $newBakselPhoto->photoFour = $photoFourName;
		}


    	$newBakselPhoto->created_at = Carbon::now();
    	$newBakselPhoto->updated_at = Carbon::now();
		$newBakselPhoto->save();

		$bakselPhotosID = $newBakselPhoto->id;

		$newBaksel = new Baksel;
		$newBaksel->title = $request->title;
		$newBaksel->description = $request->description;
		$newBaksel->timeSpend = $request->timeSpend;
		$newBaksel->bakPhotosID = $bakselPhotosID;
		$newBaksel->bakTypeID = $request->bakType;
		$newBaksel->bakStatusID = $request->bakStatus;
		$newBaksel->commentStatusID = $request->commentStatus;
		$newBaksel->created_at = Carbon::now();
		$newBaksel->updated_at = Carbon::now();
		$newBaksel->save();

		$newBakselID = $newBaksel->id;

		switch($bakselTypeName) {
		    case "Taart":
		        return redirect()->route('showTaart', ['id' => $newBakselID]);
		        break;
		    case "Decoratie":
		        return redirect()->route('showDecoratie', ['id' => $newBakselID]);
		        break;
		    case "Cupcake":
		        return redirect()->route('showAnders', ['id' => $newBakselID]);
		        break;
		    case "Anders":
		    	return redirect()->route('showAnders', ['id' => $newBakselID]);
		    	break;
		    default:
		        return redirect('/home');
		}

	}

	/********************/
	/*Met behulp van het ID word het baksel opgezocht en alle Baktypes en bak & comment status worden ook opgehaald.
	/*Omdat deze nodig zijn in het edit form
	/********************/
	public function editPost($id){

		$baksel = Baksel::findOrFail($id);
		$bakselPhotosID = $baksel->bakPhotosID;
		$bakselPhotos = Bakselphoto::findOrFail($bakselPhotosID);
		$bakStatuses = Bakstatus::all();
		$commentStatuses = Commentstatus::all();

		$bakselTypeID = $baksel->bakTypeID;
		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;
		$linkName;
		$photoMapName;

		switch($bakselTypeName) {
		    case "Taart":
		        $linkName = "/taarten/taart";
		        $photoMapName = "Taart";
		        break;
		    case "Decoratie":
		        $linkName = "/decoraties/decoratie";
		        $photoMapName = "Decoratie";
		        break;
		    case "Cupcake":
		        $linkName = "/anderecreaties/creatie";
		        $photoMapName = "Cupcake";
		        break;
		    case "Anders":
		    	$linkName = "/anderecreaties/creatie";
		    	$photoMapName = "Anders";
		    	break;
		}


		return view("baksels/bakselpost/edit", array('baksel' => $baksel,
												   	 'bakStatuses' => $bakStatuses,
												   	 'commentStatuses' => $commentStatuses,
												   	 'bakselPhotos' => $bakselPhotos,
												   	 'linkName' => $linkName,
												   	 'photoMapName' => $photoMapName));

	}

	/********************/
	/*Krijgt het post request binnen en controleerd of alles klopt met de validation
	/*Vanuit het request word er gekeken wat voor baktype en baksel bijgewerkt word.
	/*Kijkt welke fotos er zijn geupload en genereerd met behulp van de tijd een naam voor de foto.
	/*Daarna word de foto geresized naar 1920x1080 en geupload, de filenaam word ook bewaard.
	/*Waarna alles word geupdate in de database
	/*Met behulp van het baktypeID word er gekeken waarnaar de gebruiker terug gestuurt moet worden
	/*De gebruiker word naar het nieuwe artikel gestuurt die hij net gepost heeft
	/********************/
	public function editingPost($id, Request $request){

		$this->validate($request, [
       	'title' => 'required|min:1|max:75',
        'bakStatus' => 'required|min:1|max:1',
        'commentStatus' => 'required|min:1|max:1',
        'timeSpend' => 'max:75',
        'description' => 'required',
        'photoOne' => 'image|mimes:jpg,jpeg,png|max:10240',
		'photoTwo' => 'image|mimes:jpg,jpeg,png|max:10240',
		'photoThree' => 'image|mimes:jpg,jpeg,png|max:10240',
		'photoFour' => 'image|mimes:jpg,jpeg,png|max:10240'
    	]);

    	ini_set('memory_limit','2048M');

		$baksel = Baksel::findOrFail($id);
		$bakselTypeID = $baksel->bakTypeID;
		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

		$bakselToUpdate = Baksel::findOrFail($id);
		$bakselPhotosID = $bakselToUpdate->bakPhotosID;
		$bakselPhotosToUpdate = Bakselphoto::findOrFail($bakselPhotosID);

			//Als $request photoOne bevat
			if($request->hasFile('photoOne'))
			{
				//Zet de file in een variable
				$photoOne = $request->file('photoOne');
				//Genereert een filenaam met behulp van de username & tijd, tegelijkertijd word er een jpg van gemaakt
			    $photoOneName = time()+1 . "." . "jpg";
			    //Resized de foto naar 1920x1080 pixels en upload hem naar 
			    //(public/uploads/baksels/{{bakselTypeName}}/{{photoOneName}})
				Image::make($photoOne)->fit(1920,1080)
				->save(public_path("/uploads/baksels/".$bakselTypeName."/".$photoOneName));
				//Als de foto die de gebruiker nu heeft niet de standaard foto is
				if($bakselPhotosToUpdate->photoOne != NULL && $bakselPhotosToUpdate->photoOne != "defaultCake.jpg") 
				{
					//Het pad naar de upload folder en de oude avatar naam
		            $path = '/uploads/baksels/'.$bakselTypeName."/";
		            $currentPhotoName = $bakselPhotosToUpdate->photoOne;
		            //combineerd de $path en $currentAvatarName en delete de file
		            File::Delete(public_path( $path . $currentPhotoName) );
		 
		        }
		        	//Slaat de filename op in het te update baksel
		    		$bakselPhotosToUpdate->photoOne = $photoOneName;
			}

		if($request->hasFile('photoTwo'))
			{
				$photoTwo = $request->file('photoTwo');
			    $photoTwoName = time()+2 . "." . "jpg";

				Image::make($photoTwo)->fit(1920,1080)
				->save(public_path("/uploads/baksels/".$bakselTypeName."/".$photoTwoName));
				
				if($bakselPhotosToUpdate->photoTwo != NULL)
				{
					 
		            $path = '/uploads/baksels/'.$bakselTypeName."/";
		            $currentPhotoName = $bakselPhotosToUpdate->photoTwo;
		            File::Delete(public_path( $path . $currentPhotoName) );
		 
		        }
		        	
		    		$bakselPhotosToUpdate->photoTwo = $photoTwoName;
			}

		if($request->hasFile('photoThree'))
			{
				$photoThree = $request->file('photoThree');
			    $photoThreeName = time()+3 . "." . "jpg";

				Image::make($photoThree)->fit(1920,1080)
				->save(public_path("/uploads/baksels/".$bakselTypeName."/".$photoThreeName));
				
				if($bakselPhotosToUpdate->photoThree != NULL) 
				{
		            $path = '/uploads/baksels/'.$bakselTypeName."/";
		            $currentPhotoName = $bakselPhotosToUpdate->photoThree;
		            File::Delete(public_path( $path . $currentPhotoName) );
		 
		        }
		    		$bakselPhotosToUpdate->photoThree = $photoThreeName;
			}


		if($request->hasFile('photoFour'))
			{
				$photoFour = $request->file('photoFour');
			    $photoFourName = time()+4 . "." . "jpg";

				Image::make($photoFour)->fit(1920,1080)
				->save(public_path("/uploads/baksels/".$bakselTypeName."/".$photoFourName));

				if($bakselPhotosToUpdate->photoFour != NULL) 
				{
		            $path = '/uploads/baksels/'.$bakselTypeName."/";
		            $currentPhotoName = $bakselPhotosToUpdate->photoFour;
		            File::Delete(public_path( $path . $currentPhotoName) );
		 
		        }
		    		$bakselPhotosToUpdate->photoFour = $photoFourName;
			}

		$bakselPhotosToUpdate->updated_at = Carbon::now();
		$bakselPhotosToUpdate->save();

		$bakselToUpdate->title = $request->title;
		$bakselToUpdate->description = $request->description;
		$bakselToUpdate->timeSpend = $request->timeSpend;
		$bakselToUpdate->bakStatusID = $request->bakStatus;
		$bakselToUpdate->commentStatusID = $request->commentStatus;
		$bakselToUpdate->updated_at = Carbon::now();
		$bakselToUpdate->save();

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


}
	/********************/
	/* 2.7 */
	/*Met het ID word het baksel opgezocht dat gemoved moet worden.
	/*Met het bakselType ID word de naam van het type opgezocht die nodig is voor de dynamische view.
	/*Ook worden alle baktypes opgehaalt.
	/********************/
	public function movePost($id){

			$baksel = Baksel::findOrFail($id);
			$bakTypes = Baktype::all();
			$bakselTypeID = $baksel->bakTypeID;
			$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

			switch($bakselTypeName) {
			    case "Taart":
			        $linkName = "/taarten/taart";
			        $photoMapName = "Taart";
			        break;
			    case "Decoratie":
			        $linkName = "/decoraties/decoratie";
			        $photoMapName = "Decoratie";
			        break;
			    case "Cupcake":
			        $linkName = "/anderecreaties/creatie";
			        $photoMapName = "Cupcake";
			        break;
			    case "Anders":
			    	$linkName = "/anderecreaties/creatie";
			    	$photoMapName = "Anders";
			    	break;
			}

			return view("baksels/bakselpost/move", array('baksel' => $baksel,
														 'bakTypes' => $bakTypes,
													   	 'linkName' => $linkName,
													   	 'photoMapName' => $photoMapName));

	}

	/********************/
	/* 2.7 */
	/*Alle informatie van het baksel dat verplaatst moet worden word opgehaald.
	/*Er word gekeken wat de naam van de oude en nieuwe type is om de fotomappen vast te stellen.
	/*Vervolgens word er gekeken of het baksel wel een foto heeft om verplaast te worden zo ja word hij veplaast naar de nieuwe folder.
	/*Waarna er met behulp van de nieuwe type naam geredirect word
	/********************/
	public function movingPost($id, Request $request){
		$bakselToMove = Baksel::findOrFail($id);
		$bakselPhotosID = $bakselToMove->bakPhotosID;
		$bakselPhotos = Bakselphoto::findOrFail($bakselPhotosID);

		$currentTypeID = $bakselToMove->bakTypeID;
		$currentTypeName = Baktype::findOrFail($currentTypeID)->type;

		$currentPhotoMapName;

		switch($currentTypeName) {
			    case "Taart":
			        $currentPhotoMapName = "Taart";
			        break;
			    case "Decoratie":
			        $currentPhotoMapName = "Decoratie";
			        break;
			    case "Cupcake":
			        $currentPhotoMapName = "Cupcake";
			        break;
			    case "Anders":
			    	$currentPhotoMapName = "Anders";
			    	break;
		}

		$newTypeID = $request->bakType;
		$newTypeName = Baktype::findOrFail($newTypeID)->type;

		$newPhotoMapName;

		switch($newTypeName) {
			case "Taart":
			    $newPhotoMapName = "Taart";
			    break;
			case "Decoratie":
			    $newPhotoMapName = "Decoratie";
			    break;
			case "Cupcake":
			    $newPhotoMapName = "Cupcake";
			    break;
			case "Anders":
				$newPhotoMapName = "Anders";
				break;
		}

		if($bakselPhotos->photoOne != NULL && $bakselPhotos->photoOne != "defaultCake.jpg"){
			$photoOne = $bakselPhotos->photoOne;
			$oldPathOne = 'uploads/baksels/'.$currentPhotoMapName.'/'.$photoOne;
			$newPathOne = 'uploads/baksels/'.$newPhotoMapName.'/'.$photoOne;

			Storage::move('uploads/baksels/'.$currentPhotoMapName.'/'.$photoOne, 'uploads/baksels/'.$newPhotoMapName.'/'.$photoOne);
		}

		if($bakselPhotos->photoTwo != NULL){
			$photoTwo = $bakselPhotos->photoTwo;
			$oldPathOne = 'uploads/baksels/'.$currentPhotoMapName.'/'.$photoTwo;
			$newPathOne = 'uploads/baksels/'.$newPhotoMapName.'/'.$photoTwo;

			Storage::move('uploads/baksels/'.$currentPhotoMapName.'/'.$photoTwo, 'uploads/baksels/'.$newPhotoMapName.'/'.$photoTwo);
		}

		if($bakselPhotos->photoThree != NULL){
			$photoThree = $bakselPhotos->photoThree;
			$oldPathOne = 'uploads/baksels/'.$currentPhotoMapName.'/'.$photoThree;
			$newPathOne = 'uploads/baksels/'.$newPhotoMapName.'/'.$photoThree;

			Storage::move('uploads/baksels/'.$currentPhotoMapName.'/'.$photoThree, 'uploads/baksels/'.$newPhotoMapName.'/'.$photoThree);
		}

		if($bakselPhotos->photoFour != NULL){
			$photoFour = $bakselPhotos->photoFour;
			$oldPathOne = 'uploads/baksels/'.$currentPhotoMapName.'/'.$photoFour;
			$newPathOne = 'uploads/baksels/'.$newPhotoMapName.'/'.$photoFour;

			Storage::move('uploads/baksels/'.$currentPhotoMapName.'/'.$photoFour, 'uploads/baksels/'.$newPhotoMapName.'/'.$photoFour);
		}

		$bakselToMove->bakTypeID = $newTypeID;
		$bakselToMove->save();


			switch($newTypeName) {
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
	}

	/********************/
	/* 2.7 */
	/*Delete Foto*/
	/*Haalt alle fotos op die bij het gekoze baksel horen
	/********************/
	public function deleteFoto($id){
		$baksel = Baksel::findOrFail($id);
		$bakselID = $id;
		$bakselPhotosID = $baksel->bakPhotosID;
		$bakselPhotosToDelete = Bakselphoto::findOrFail($bakselPhotosID);
		$bakselTypeID = $baksel->bakTypeID;
		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

		$linkName;

			switch ($bakselTypeName) {
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


	   return view("baksels/bakselpost/deletephoto", array('bakselPhotosToDelete' => $bakselPhotosToDelete,
														   'linkName' => $linkName,
														   'bakselTypeName' => $bakselTypeName,
														   'baksel' => $baksel,
														   'bakselID' => $bakselID));

	}

	/********************/
	/*Krijgt het foto nummer binnen via de POST request
	/*Er word voor de zekerheid gecontroleerd of het nummer wel bestaat en of hij gelijk is aan een van de vier velden
	/*Dan word alle informatie opgehaald en gekeken welke foto er gedelete moet worden en naar NULL gezet moet worden in de database.
	/*Als het de eerste foto is word hij niet naar NULL gezet maar naar de defaultCake.jpg
	/*Na verwijderen en het updaten van de database word de gebruiker terug geredirect
	/********************/
	public function deletingFoto($id, Request $request){
		$fotoNr = $request->fotoNr;

		if($fotoNr != NULL && $fotoNr == "photoOne" || $fotoNr == "photoTwo" || $fotoNr == "photoThree" || $fotoNr == "photoFour"){

			$baksel = Baksel::findOrFail($id);
			$bakselID = $id;
			$bakselPhotosID = $baksel->bakPhotosID;
			$bakselPhotosToDelete = Bakselphoto::findOrFail($bakselPhotosID);
			$bakselTypeID = $baksel->bakTypeID;
			$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

			$path = '/uploads/baksels/'.$bakselTypeName."/";

			if($fotoNr == "photoOne"){
				$currentPhotoName = $bakselPhotosToDelete->$fotoNr;

				File::Delete(public_path( $path . $currentPhotoName) );
				$bakselPhotosToDelete->$fotoNr = "defaultCake.jpg";
				$bakselPhotosToDelete->save();
			}else{
				$currentPhotoName = $bakselPhotosToDelete->$fotoNr;

				File::Delete(public_path( $path . $currentPhotoName) );
				$bakselPhotosToDelete->$fotoNr = NULL;
				$bakselPhotosToDelete->save();
			}


			switch($bakselTypeName) {
			    case "Taart":
			        return redirect()->route('taartFotoDel', ['id' => $id]);
			        break;
			    case "Decoratie":
			        return redirect()->route('decorFotoDel', ['id' => $id]);
			        break;
			    case "Cupcake":
			        return redirect()->route('anderFotoDel', ['id' => $id]);
			        break;
			    case "Anders":
			    	return redirect()->route('anderFotoDel', ['id' => $id]);
			    	break;
			    default:
			        return redirect('/home');
			}
		}else{
			return redirect('/home');
		}
	}

	/********************/
	/*Met het ID word het baksel opgezocht dat gedelete moet worden
	/*Vanuit het baksel word het BakselType opgezocht waarmee de link word opgeslagen.
	/*Dit is nodig omdat de delete view dynamisch is.
	/*De dynamische view word ingeladen met alle data en de linkName
	/********************/
	public function deletePost($id){
		$bakselToDelete = Baksel::findOrFail($id);
		$bakselTypeID = $bakselToDelete->bakTypeID;
		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;

		$bakselID = $bakselToDelete->id;
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

		return view("baksels/bakselpost/delete", array('bakselToDelete' => $bakselToDelete,
													   'linkName' => $linkName,
													   'bakselID' => $bakselID));
		}

	/********************/
	/*Met het meegestuurde ID word het baksel opgezocht dat gedelete moet worden
	/*Waarmee het Bakseltype, Fotos en comments ook worden opgehaald.
	/*Als eerst word er over de opgehaalde comments gelooped om ze te deleten.
	/*Daarna word er een path opgeslagen naar de fotos en word er gekeken welke er geupload zijn.
	/*Als er een foto geupload is word de file gedelete, waarna de baksel gedelete word in de database
	/*En daarna de fotos, en met behulp van de bakselType naam word de gebruiker geredirect.
	/********************/
	public function deletingPost($id, Request $request){

		$bakselToDelete = Baksel::findOrFail($id);
		$bakselTypeID = $bakselToDelete->bakTypeID;
		$bakselTypeName = Baktype::findOrFail($bakselTypeID)->type;
		$bakselPhotosID = $bakselToDelete->bakPhotosID;
		$bakselPhotosToDelete = Bakselphoto::findOrFail($bakselPhotosID);

		$bakselID = $bakselToDelete->id;

		$commentsToDelete = Comment::where('bakselID', '=', $bakselID)->get();
			foreach($commentsToDelete as $commentToDelete){
				$commentToDelete->delete();
			}

		$path = '/uploads/baksels/'.$bakselTypeName."/";

		if($bakselPhotosToDelete->photoOne != NULL && $bakselPhotosToDelete->photoOne != "defaultCake.jpg"){
			$photoOneName = $bakselPhotosToDelete->photoOne;
			File::Delete(public_path( $path . $photoOneName) );
		}
		if($bakselPhotosToDelete->photoTwo != NULL){
			$photoTwoName = $bakselPhotosToDelete->photoTwo;
			File::Delete(public_path( $path . $photoTwoName) );
		}
		if($bakselPhotosToDelete->photoThree != NULL){
			$photoThreeName = $bakselPhotosToDelete->photoThree;
			File::Delete(public_path( $path . $photoThreeName) );
		}
		if($bakselPhotosToDelete->photoFour != NULL){
			$photoFourName = $bakselPhotosToDelete->photoFour;
			File::Delete(public_path( $path . $photoFourName) );
		}

		$bakselToDelete->delete();
		$bakselPhotosToDelete->delete();

		switch($bakselTypeName) {
		    case "Taart":
		        return redirect()->route('taartIndex');
		        break;
		    case "Decoratie":
		        return redirect()->route('decoratieIndex');
		        break;
		    case "Cupcake":
		        return redirect()->route('andersIndex');
		        break;
		    case "Anders":
				return redirect()->route('andersIndex');
		    	break;
		    default:
		        return redirect('/home');
		}

	}



}
