<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Isotopeimage extends Model
{
    public function getIsoTypeOne(){
        return Isotopetype::where('id', $this->isoTypeOne)->first()->type;
    }
    public function getIsoTypeTwo(){
        return Isotopetype::where('id', $this->isoTypeTwo)->first()->type;
    }
}
