<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sliderimage;
use App\Isotopeimage;
use App\Isotopetype;
use App\Frontquote;
use App\User;

use Carbon\Carbon;

use Auth;
use File;
use Image;
use DB;
class AdminController extends Controller
{

	/********************/
	/* Index van beheer
	/********************/
	public function index(){
		return view('admin/index');
	}

	/********************/
	/* Haalt alle sliders op en stuurt ze op naar de view
	/********************/
    public function listSliders(){
    	$allSliders = Sliderimage::all();
    	return view('admin/sliders/index', array('allSliders' => $allSliders));
    }

    /********************/
	/*Haalt alle isotope(gallerij op de voor pagina) fotos op en stuurt ze naar de view
	/********************/
	public function listIsotope(){
		$allIsotopes = Isotopeimage::orderBy('id', 'asc')->paginate(5);
		return view('admin/isotope/index', array('allIsotopes' => $allIsotopes));
	}

	/********************/
	/*Haalt alle informatie van de quote op (1) want er is er maar een, en stuurt deze naar de view
	/********************/
	public function editFrontQuote(){

		$frontQuoteToUpdate = Frontquote::find(1);

		return view('admin/frontquote/edit', array('frontQuoteToUpdate' => $frontQuoteToUpdate));
	}

	/********************/
	/*Als de editQuote form gesubmit word word er gekeken of er een foto bij de request zit.
	/*Zo ja word de oude foto gedelete en de nieuwe geresized en geupload.
	/*De quote en updated tijd word ook geupdate en opgeslagen
	/********************/
	public function editingFrontQuote(Request $request){

		$this->validate($request, [
		   	'quote' => 'required|min:6|max:75',
            'image' => 'image|mimes:jpg,jpeg,png|max:10240',
    	]);

		$frontQuoteToUpdate = Frontquote::find(1);

		if($request->hasFile('image'))
        {
            $frontpagePhoto = $request->file('image');

            $currentfilename = $frontQuoteToUpdate->imageName;
            $newfilename = "frontPhoto_".time().".jpg";
            $path = '/uploads/frontpage/';

            File::Delete(public_path("/uploads/frontpage/" . $currentfilename ));

            Image::make($frontpagePhoto)->fit(400,300)->save(public_path("/uploads/frontpage/" . $newfilename ));
            $frontQuoteToUpdate->imageName = $newfilename;
        }

        $frontQuoteToUpdate->quote = $request->quote;
        $frontQuoteToUpdate->updated_at = Carbon::now();
        $frontQuoteToUpdate->save();

        return redirect()->route('home');
	}

	/********************/
	/*Haalt alle users op en orderd ze van nieuw naar oud en stuurt ze naar de view
	/********************/
	public function userList(){
		$allUsers = User::orderBy('id', 'desc')->paginate(5);
		return view('admin/users/userlist', array('allUsers' => $allUsers));
	}
}
