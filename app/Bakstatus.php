<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bakstatus extends Model
{
	//Overschrijft de tabel naam (Hij zoekt naar de tabel Bakstatuses inplaats van Bakstatus)
    public $table = 'bakstatus';
}
