<?php

namespace App;

class Order extends Model
{
    //order->customer
	public function customer(){
		return $this->belongsTo(Customer::class);
	}

	public function product(){
		return $this->hasMany(Product::class);
	}

	public function printorder(){
		return $this->belongsTo(PrintOrder::class);
	}
}
