<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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

class DecoratiesController extends Controller
{
    /********************/
    /*Haalt alle baksels op met het TypeID van 2 (Decoraties) en fotos op en orderd ze van nieuw naar oud, en paginate ze per 3.
    /*Er worden page Titles en links vast gestelt omdat ze naar een dynamische view gestuurt worden.
    /*2.7 Zoek functie toegevoegd, met een paginate value van 9999 om error tegen te gaan van de dynamische pagina.
    /********************/
    public function index(Request $request){

        $decoraties = Baksel::where('bakTypeID', '=', 2)->orderBy("created_at", "desc")->paginate(3);
        $allPhotos = Bakselphoto::all();

        $linkName = "/decoraties/maken";
        $titleLink = "/decoraties/decoratie";
        $titleNameMulti = "Decoraties";
        $titleNameSingle = "Decoratie";
        $titleMultiLower = "decoraties";


            if($request->zoek){
                $zoek = $request->zoek;
                $this->validate($request, [
                    'zoek' => 'required|min:3|max:25'
                ]);

                $zoekDecoraties = Baksel::where('bakTypeID', '=', 2)->where('title', "LIKE", "%$zoek%")->orderBy("created_at", "desc")->paginate(9999);

                return view('baksels/baksels', array('creaties' => $zoekDecoraties,
                                                     'allPhotos' => $allPhotos,
                                                     'linkName' => $linkName,
                                                     'titleLink' => $titleLink,
                                                     'titleNameMulti' => $titleNameMulti,
                                                     'titleNameSingle' => $titleNameSingle,
                                                     'titleMultiLower' => $titleMultiLower));
            }

        return view('baksels/baksels', array('creaties' => $decoraties,
                                                 'allPhotos' => $allPhotos,
                                                 'linkName' => $linkName,
                                                 'titleLink' => $titleLink,
                                                 'titleNameMulti' => $titleNameMulti,
                                                 'titleNameSingle' => $titleNameSingle,
                                                 'titleMultiLower' => $titleMultiLower));
    }

    /********************/
    /*Zoekt de decoratie op met behulp van het ID.
    /*Met het zelfde ID worden ook de eerste 4 comments die op de decoratie gemaakt zijn opgehaald en van nieuw naar oud gesorteert, waarna ook ALLE comments die met de decoratie te maken hebben opgehaald worden en getelt hoeveel het er zijn.
    /*Dit is voor de ajax knop, als er meer comments zijn dan 4 word hij laten zien anders niet.
    /*En weer een link vast gestelt omdat alles naar een dynamische view gestuurt word
    /********************/
    public function showDecoratie($id){
        
        $decoratie = Baksel::findOrFail($id);
        $decoratieID = $decoratie->id;
        $comments = Comment::where('bakselID', '=', $decoratieID)->orderBy("created_at", "desc")->take(4)->get();

        $allComments = Comment::where('bakselID', '=', $decoratieID)->get();
        $allCommentsCount = count($allComments);

        $linkName = "/decoraties/decoratie";
        return view('baksels/baksel', array('creatie' => $decoratie,
                                            'comments' => $comments,
                                            'linkName' => $linkName,
                                            'allCommentsCount' => $allCommentsCount));
    }
}
