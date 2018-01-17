<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sliderimage;
use App\Isotopeimage;
use App\Isotopetype;
use App\Frontquote;
use App\Baksel;
use App\Baktype;

class PagesController extends Controller
{

 /********************/
 /*Haalt alle sliders, isotopes, en quote op.
 /*Ook word er getelt hoeveel baksels van elk type er zijn gemaakt voor de counter.
 /********************/
    public function index()
    {
        $allSliders = Sliderimage::all();
        $allIstopeimages = Isotopeimage::all();
        $frontQuote = Frontquote::find(1);

        $countTaarten = Baksel::where('bakTypeID', '=', 1)->count();
        $countDecoraties = Baksel::where('bakTypeID', '=', 2)->count();
        $countAnders = Baksel::where('bakTypeID', '=', 3)->orWhere('bakTypeID', '=', 4)->count();

        return view('pages/home', array('allSliders' => $allSliders,
                                        'allIstopeimages' => $allIstopeimages,
                                        'frontQuote' => $frontQuote,
                                        'countTaarten' => $countTaarten,
                                        'countDecoraties' => $countDecoraties,
                                        'countAnders' => $countAnders));
    }

}
