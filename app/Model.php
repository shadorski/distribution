<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    //
    //allows everything to be submitted to the server 
    protected $guarded = [];
}
