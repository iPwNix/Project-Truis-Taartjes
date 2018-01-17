<?php
namespace App\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;


class HDPresenter extends BootstrapThreePresenter {


    public function render()

    {

        if ($this->hasPages()) {

            return sprintf(

                '<div class="pagi-custom row"><div class="pull-left prev-buttons col-xs-12 col-sm-6">%s %s</div> <div class="pull-right next-buttons col-xs-12 col-sm-6">%s %s</div></div>',

                $this->getFirst(),

                $this->getButtonPre(),

                $this->getButtonNext(),

                $this->getLast()

            );

        }

        return "";

    }


    public function getLast()

    {

        $url = $this->paginator->url($this->paginator->lastPage());

        $btnStatus = '';


        if($this->paginator->lastPage() == $this->paginator->currentPage()){

            $btnStatus = 'disabled';
            return $btn = "<a><button class='btn btn-success last-button ".$btnStatus."'>Laatste <i class='glyphicon glyphicon-chevron-right'></i></button></a>";

        }else{
            return $btn = "<a href='".$url."'><button class='btn btn-success last-button ".$btnStatus."'>Laatste <i class='glyphicon glyphicon-chevron-right'></i></button></a>";
        }

        

    }


    public function getFirst()

    {

        $url = $this->paginator->url(1);

        $btnStatus = '';


        if(1 == $this->paginator->currentPage()){

            $btnStatus = 'disabled';
            return $btn = "<a><button class='btn btn-success first-button ".$btnStatus."'><i class='glyphicon glyphicon-chevron-left'></i> Eerste</button></a>";   

        }else{
            return $btn = "<a href='".$url."'><button class='btn btn-success first-button ".$btnStatus."'><i class='glyphicon glyphicon-chevron-left'></i> Eerste</button></a>";            
        }



    }


    public function getButtonPre()

    {

        $url = $this->paginator->previousPageUrl();

        $btnStatus = '';


        if(empty($url)){

            $btnStatus = 'disabled';
            return $btn = "<a><button class='btn btn-success previous-button ".$btnStatus."'><i class='glyphicon glyphicon-chevron-left pagi-margin'></i><i class='glyphicon glyphicon-chevron-left'></i> Vorige</button></a>";   
        }else{
            return $btn = "<a href='".$url."'><button class='btn btn-success previous-button ".$btnStatus."'><i class='glyphicon glyphicon-chevron-left pagi-margin'></i><i class='glyphicon glyphicon-chevron-left'></i> Vorige</button></a>";            
        }



    }


    public function getButtonNext()

    {

        $url = $this->paginator->nextPageUrl();

        $btnStatus = '';


        if(empty($url)){

            $btnStatus = 'disabled';
            return $btn = "<a><button class='btn btn-success next-button ".$btnStatus."'>Volgende <i class='glyphicon glyphicon-chevron-right pagi-margin'></i><i class='glyphicon glyphicon-chevron-right'></i></button></a>"; 
        }else{
            return $btn = "<a href='".$url."'><button class='btn btn-success next-button ".$btnStatus."'>Volgende <i class='glyphicon glyphicon-chevron-right pagi-margin'></i><i class='glyphicon glyphicon-chevron-right'></i></button></a>"; 
        }



    }


}