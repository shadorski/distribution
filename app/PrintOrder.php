<?php

namespace App;
use Carbon\Carbon;
use DateTime;
use DateInterval;

class PrintOrder extends Model
{
    //relationship
    public function order(){
    	return $this->hasMany(Order::class);
    }

    //last batch od
    public function latest_batch_id(){
    	$po_date = PrintOrder::order_date();
        //dd($po_date);
        $printorder = PrintOrder::where('batch_id', 'like', $po_date.'%')->orderBy('batch_id', 'desc')->take(1)->get();
        return $printorder;
    }

    //generate date of next print order
    public function order_date(){
    	$po_date =  new DateTime();
        $po_date->add(new DateInterval('P1D'));
        $po_date = date('Ymd', strtotime($po_date->format('Y-m-d')));
        return $po_date;
    }

    //get orders per batch_id
    public function getOrders($po){
    	$batch_id = "";
    	foreach ($po as $o){
    		$batch_id=$o->batch_id;
    	}
    	$order_ids = PrintOrder::where('batch_id', $batch_id)->pluck('order_id');
    	//dd($order_ids);
    	$order_id_array = array();
    	foreach($order_ids as $order_id){
    		array_push($order_id_array, $order_id);
    	}
    	//dd($order_id_array);
    	$orders = Order::findMany($order_id_array);
    	//dd($orders);
        return $orders;
    }

    //get publication
    public function get_pub($pub_date){
        switch($pub_date){
                case "Saturday":
                    $code = "zdm02";
                break;
                case "Sunday":
                    $code = "zdm03";
                break;
                default:
                    $code = "zdm01";
                break;
            }
            $publication = Product::where('code', $code)->pluck('product_name');
            foreach($publication as $publi){
                $pub = $publi;
            }
            return $pub;
    }

    //get total
    public function get_totals($batch_id){
        $total = 0;
        $order_ids = PrintOrder::where('batch_id', $batch_id)->get();
        //calculate total of orders in this batch
        foreach($order_ids as $order_item){
            $total += $order_item->qty;
        }        
        return $total;
    }

    public function get_pub_date($printOrder){
        //get publication
        //dd($printOrder);
        $pub_date = substr(trim($printOrder),0,-1);
        $pub_date = Carbon::parse($pub_date);
        //dd($pub_date);
        $pub_date = $pub_date->format('l');
        //dd($pub_date);
        $pub = PrintOrder::get_pub($pub_date);
        return $pub;
    }
}
