<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use App\Http\Requests;
use App\Sliderimage;
use App\Isotopeimage;
use App\Isotopetype;

use Auth;
use File;
use Image;
use DB;
use Storage;

class ImageController extends Controller
{
    /********************/
    /*Zoekt de slider op met behulp van het id
    /*En stuurt deze op naar de slider edit view
    /********************/
    public function editSlider($id){
    	$sliderToUpdate = Sliderimage::findOrFail($id);

    	return view('admin/sliders/edit', array('sliderToUpdate' => $sliderToUpdate));
    }

    /********************/
    /*De slider die geupdat moet worden word opgezocht met behulp van het ID
    /*En word gekeken of er een foto is mee gestuurt zo ja word deze geresized en geupload
    /*De meegestuurde title, caption en de tijd op dat moment worden opgeslagen in de database
    /*De foto hoeft niet opnieuw opgeslagen te worden in de database want de naam blijft het zelfde
    /*En de gebruiker word terug gestuurt naar de lijst van alle sliders.
    /********************/
    public function editingSlider($id, Request $request){

        $this->validate($request, [
            'title' => 'max:20',
            'caption' => 'max:25',
            'image' => 'image|mimes:jpg,jpeg,png|max:10240'
        ]);

        $sliderToUpdate = Sliderimage::findOrFail($id);

        if($request->hasFile('image'))
        {
            $slideimage = $request->file('image');

            $currentfilename = $sliderToUpdate->imageName;
            $newfilename = "slider".$id."_".time().".jpg";

            $path = '/uploads/frontslider/';

            File::Delete(public_path("/uploads/frontslider/" . $currentfilename ));

            Image::make($slideimage)->fit(1920,1080)->save(public_path("/uploads/frontslider/" . $newfilename ));
            $sliderToUpdate->imageName = $newfilename;
        }

    	$sliderToUpdate->sliderTitle = $request->title;
    	$sliderToUpdate->sliderCaption = $request->caption;
    	$sliderToUpdate->updated_at = Carbon::now();

    	$sliderToUpdate->save();

    	return redirect()->route('sliderIndex');


    }
    /********************/
    /*Haalt met behulp van ID de isoTope foto op
    /*Haalt isoTope types op en stuurt ze mee naar de edit view
    /********************/
    public function editIsotope($id){

        $isoTopeToUpdate = Isotopeimage::findOrFail($id);
        $isotopeTypesOne = Isotopetype::where('id', '=', 1)->orWhere('id', '=', 2)->orWhere('id', '=', 3)->orderBy("id", "asc")->get();
        $isotopeTypes = Isotopetype::all();
        return view('admin/isotope/edit', array('isoTopeToUpdate' => $isoTopeToUpdate,
                                                'isotopeTypesOne' => $isotopeTypesOne,
                                                'isotopeTypes' => $isotopeTypes));
    }

    /********************/
    /*Met behulp van het id word de isoTope foto opgehaalt
    /*Als de tweede isotope type 4 (Geen) word hij naar NULL gezet
    /*Als er een image is mee gestuurt word deze geresized en geupload.
    /*Waarna alle mee gegeve gegevens opgeslagen worden in de database en de gebruiker terug gestuurt word naar de isotope index
    /********************/
    public function editingIsoTope($id, Request $request){

        $this->validate($request, [
            'isoTypeOne' => 'required',
            'isoTypeTwo' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:10240'
        ]);
        
        $isoTopeToUpdate = Isotopeimage::findOrFail($id);
        $isoTypeOne = $request->isoTypeOne;
        $isoTypeTwo = $request->isoTypeTwo;

        if($isoTypeTwo == 4){
            $isoTypeTwo = NULL;
        }

        if($request->hasFile('image'))
        {
            $isotopefoto = $request->file('image');

            $currentfilename = $isoTopeToUpdate->imageName;
            $newfilename = "isotope".$id."_".time().".jpg";

            $path = '/uploads/isotopes/';

            File::Delete(public_path("/uploads/isotopes/" . $currentfilename ));

            Image::make($isotopefoto)->fit(400,300)->save(public_path("/uploads/isotopes/" . $newfilename ));
            $isoTopeToUpdate->imageName = $newfilename;
        }
            $isoTopeToUpdate->isoTypeOne = $isoTypeOne;
            $isoTopeToUpdate->isoTypeTwo = $isoTypeTwo;
            $isoTopeToUpdate->updated_at = Carbon::now();
            $isoTopeToUpdate->save();

            return redirect()->route('isotopeIndex');
    }
}
