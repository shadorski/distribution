<?php

namespace App;

class Product extends Model
{
    //
    public function order(){
    	return $this->belongsTo(Order::class);
    }
}
