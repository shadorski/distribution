<?php

namespace App;


class Route extends Model
{
    public function customer(){
    	return $this->hasMany(Customer::class, 'route');
    }
}
