<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Order;

class MigrationController extends Controller
{
    //

    public function index(){
    //create a join of old customer and order tables 
    $stuff = DB::table('old_distribution.customer_v2')->join('old_distribution.order_v2', 'old_distribution.customer_v2.id', '=', 'order_v2.customer_id')->get();
    	//dd($stuff);

	    foreach($stuff as $item){
	    	//dd($item->customer_name);
	    	$address = $item->address;
	    	$phone = preg_replace('`\D`','',$item->phone);
	    	Customer::create(['customer_name'=>$item->customer_name, 'contact_person'=>$item->contact_person, 'email'=>$item->email, 'postal'=>' ', 'address'=>$address, 'phone_number'=>$phone, 'route'=>$item->route, 'customer_type'=>$item->customer_type_id]);
	    	$customer_id = Customer::all()->last()->id;

	    	Order::create(['customer_id'=>$customer_id, 'zdm01'=>$item->zdm01, 'zdm02'=>$item->zdm02, 'zdm03'=>$item->zdm03, 'zdm04'=>0, 'transport'=>false, 'start_date'=>$item->startDate, 'end_date'=>$item->endDate, 'status'=>true]);
	    }
    }
}
