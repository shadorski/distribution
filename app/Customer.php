<?php

namespace App;
//use Laravel\Scout\Searchable;

class Customer extends Model
{
	//use Searchable;

    public function order(){
    	return $this->hasMany(Order::class);
    }

    public function route(){
    	return $this->belongsTo(Route::class);
    }

    public function search($searchItem){
    	//search customer name, contact person, and address
    	$results = Customer::distinct()->where('customer_name', 'like', '%'.$searchItem.'%')->orWhere('contact_person','like','%'.$searchItem.'%')->orWhere('address','like','%'.$searchItem.'%')->orderBy('id', 'asc')->get();
    		return $results;
    }
}
