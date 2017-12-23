<?php

namespace App\Http\Controllers;

use App\PrintOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use App\Order;
use App\Product;
use App\Route;
use PDF;

class PrintOrderController extends Controller
{
   
    public function index()
    {
        //check to see if we have any processing or processed print orders in db
        //assume the batch number of format: date(tomorrow)+increment number e.g. 201710061 (YYYYMMDD*No*)
        //$po_date = Carbon::tomorrow()->format('YYYYMMDD');
        $po = new PrintOrder;
        $po_date = $po->order_date();
        $printorder = PrintOrder::where('batch_id', 'LIKE', $po_date.'%')->get();
        //dd($printorder);
        //chech if any print order exists for tomorrow
        $batch = null;
        if($printorder->isEmpty()){ 
            //dd("Dead");
            //$batch = null;
            $new_batch = $po_date."1";
            //dd($batch);
            //old archives
            $old_print_orders = PrintOrder::distinct()->select('batch_id', 'status')->where('batch_id', '<>', $new_batch)->limit(4)->orderBy('batch_id', 'desc')->get();
           //dd($old_print_orders);
            //$pdf = PDF::loadView('printorders.index', compact('batch', 'old_print_orders'));
            //return $pdf->download('test.pdf');
            return view('printorders.index', compact('batch', 'old_print_orders'));
        }else{
            
            $batch = $printorder->last();
                //dd($batch);
                //get total
                $total = $po->get_totals($batch->batch_id);
                
                //get order_ids of batch
                $order_ids = PrintOrder::where('batch_id', $batch->batch_id)->get();
                $order_id_array = array();
                foreach($order_ids as $order_id){
                    array_push($order_id_array, $order_id->order_id);
                }
                //dd($order_id_array);
                $orders = Order::findMany($order_id_array);
                
                //
                //get publication
                    $pud_date = Carbon::tomorrow()->format('l');
                    switch($pud_date){
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
                //$total = 0;
                //foreach($orders as $order){
                    //dd($order);
                    //$total += $order->$code;
                //}
                $publication = Product::where('code', $code)->pluck('product_name');
                    foreach($publication as $publi){
                        $pub = $publi;
                }
               //old archives
                $old_print_orders = PrintOrder::distinct()->select('batch_id', 'status')->where('batch_id', '<>', $batch->batch_id)->limit(4)->orderBy('batch_id', 'desc')->get();
                //dd($old_print_orders);
                
                //add reference date
                $ref_date = $po->order_date();
                //dd($batch);
                //check if their is an approval entry for current batch
                $approval_status = \DB::table('print_order_verify')->where('batch_id', $batch->batch_id)->get();
                //dd($approval_status);
                //$batch = $batch->batch_id;
                return view('printorders.index', compact('batch', 'total', 'pub', 'old_print_orders','ref_date'));
        }
        
    }

    public function create()
    {
        //create a batch id
            //first check if their is a batch id already
            //then create a new batch with the appropriate num and save the valid orders
        //check for id
        $po = new PrintOrder;
        $last_batch_id = $po->latest_batch_id();
        $date = Carbon::tomorrow()->format('d/m/y');
        //dd($date);
        if($last_batch_id->isEmpty()){
            //create new batch
            $new_batch_id = $po->order_date();
            //create new PrintOrder instance to save
            $new_po = new PrintOrder;
            //add values to save
            $new_po->batch_id = $new_batch_id."1";
            //get all valid orders
            $orders = Order::where('status', 1)->get();
            //get publication
            $pud_date = Carbon::tomorrow()->format('l');
            switch($pud_date){
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
            foreach($orders as $order){
                $new_po = new PrintOrder;
                //add values to save
                $new_po->batch_id = $new_batch_id."1";
                $new_po->order_id = $order->id;
                $new_po->status = false;
                $new_po->qty = $order->$code;
                $new_po->save();
            }
            //get orders and send them to show view
            $order_data = new PrintOrder;
            //dd($new_po);
            $last_batch_id=$order_data->latest_batch_id();
            $orders = $order_data->getOrders($last_batch_id);
           
            //get publication
            $pud_date = Carbon::tomorrow()->format('l');
            switch($pud_date){
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

            //get total
            $total = 0;
            foreach($orders as $order){
                $total += $order->$code;
            }
            //
            //$batch = $last_batch_id;
            $routes = Route::all();
            foreach($last_batch_id as $batch){
                $batch = $batch;
            }
            return view('printorders.show', compact('batch', 'orders', 'date', 'pub', 'code', 'total', 'routes'));
            //get batch and die
            //dd($po = PrintOrder::where('batch_id', $new_po->batch_id)->get());
        }else{
            $new_po = $last_batch_id;
            $order_data = new PrintOrder;
            $orders = $order_data->getOrders($new_po);
            //dd($orders);
            //get publication
            $pud_date = Carbon::tomorrow()->format('l');
            switch($pud_date){
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

            //get total
            $total = 0;
            foreach($orders as $order){
                $total += $order->$code;
            }
            $routes = Route::all();
            foreach($last_batch_id as $batch){
                $batch = $batch;
            }
            return view('printorders.show', compact('batch', 'orders', 'date', 'pub', 'code', 'total', 'routes'));
        }
         
    }

    public function store(Request $request)
    {
        //dd($request->all());
        //get all orders in batch
        
        $batch_id = $request->batch_id;
        $order_ids = PrintOrder::where('batch_id', $batch_id)->pluck('order_id');
        
        $order_data = Order::findMany($order_ids);
        //dd($order_data);
        $altered_orders = [];
        foreach($order_data as $order){
            $current_order_id = $order->id;
            //dd($order->id);
           // dd($request->input($current_order_id));
            $request_data = $request->input($current_order_id);
            //dd($request_data);
            $po = new PrintOrder;
            $pud_date = Carbon::tomorrow()->format('l');
            switch($pud_date){
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
            //$altered_orders = [];
            if($request_data <> $order->$code){
                //log change
                //save all changes to array
                $altered_orders [] = [
                    "order_id" => $current_order_id,
                    $code => $request->$current_order_id,
                    "created_at" =>  Carbon::now()->format('Y-m-d h:s:i'),
                ]; 
                foreach($altered_orders as $order){
                //dd($order);
                $id = $order['order_id'];
                $order_obj = Order::find($id);
               //update order_log to show new values
                 $order_copy = Order::find($order['order_id']);
                    //dd($order_copy);
                    $id = \DB::table('order_log')->insertGetId(['order_id'=>$order_copy->id, 'zdm01'=>$order_copy->zdm01, 'zdm02'=>$order_copy->zdm02, 'zdm03'=>$order_copy->zdm03, 'zdm04'=>$order_copy->zdm04, 'created_at'=> Carbon::now()->format('Y-m-d h:s:i')]);
                $order_obj->update([$code => $order[$code]]);
                //update print order 
                $update_po = PrintOrder::where([['batch_id','=', $batch_id], ['order_id','=', $order_copy->id]])->first();
                //dd($update_po);
                //dd($order[$code]);
                $update_po->where([['batch_id','=', $batch_id], ['order_id','=', $order_copy->id]])->update(['qty'=> $order[$code]]);
               }
                       
            }
        }
        
        //\DB::table('order_log')->insert($altered_orders);
        //update order table with new quantities
        return redirect('/printorders');

    }

    
    public function show($printOrder)
    {
        //check order submitted against saved, if different create new order disable the old
        
        //
        $date = Carbon::tomorrow()->format('d/m/y');
        $batch = new PrintOrder;
        $order_ids = PrintOrder::where('batch_id', $printOrder)->pluck('order_id');
        //dd($order_ids);
        $order_id_array = array();
        foreach($order_ids as $order_id){
            array_push($order_id_array, $order_id);
        }
        //dd($order_id_array);
        $orders = Order::findMany($order_id_array);

        //get publication
        $pub_date = substr(trim($printOrder),0,-1);
        $pub_date = Carbon::create($pub_date)->format('l');

        //dd($pub_date);
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
        //get total
        $total = $batch->get_totals($printOrder);
        //dd($total);
        //dd($total);
        $routes = Route::all();
        //$pdf = PDF::loadView('printorders.show', compact('orders', 'date','pub', 'code', 'total', 'routes'));
                //return $pdf->download('test.pdf');
        $batch_id = $printOrder;
        $batch = $batch->where('batch_id',$printOrder)->first();
        //dd($batch);
        return view('printorders.show', compact('batch', 'orders', 'date','pub', 'code', 'total', 'routes', 'total', 'pub_date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrintOrder  $printOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($printOrder)
    {
        $date = Carbon::tomorrow()->format('d/m/y');
        $batch = new PrintOrder;
        $order_ids = PrintOrder::where('batch_id', $printOrder)->pluck('order_id');
        //dd($order_ids);
        $order_id_array = array();
        foreach($order_ids as $order_id){
            array_push($order_id_array, $order_id);
        }
        //dd($order_id_array);
        $orders = Order::findMany($order_id_array);

        //get publication
        $pud_date = Carbon::tomorrow()->format('l');
        switch($pud_date){
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
        //get total
        $total = 0;
        foreach($orders as $order){
            $total += $order->$code;
        }

        //dd($total);
        $routes = Route::all();
        //batch id
        $batch_id = PrintOrder::where('batch_id', $printOrder)->pluck('batch_id')->last();
        
        return view('printorders.edit', compact('orders', 'date','pub', 'code', 'total', 'routes', 'batch_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrintOrder  $printOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrintOrder $printOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrintOrder  $printOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrintOrder $printOrder)
    {
        //
    }

    public function print($printOrder)
    {
        //get orders as per printorder id
        //
        $date = Carbon::tomorrow()->format('d/m/y');
        $batch = new PrintOrder;
        $order_ids = PrintOrder::where('batch_id', $printOrder)->pluck('order_id');
        //dd($order_ids);
        $order_id_array = array();
        foreach($order_ids as $order_id){
            array_push($order_id_array, $order_id);
        }
        //dd($order_id_array);
        $orders = Order::findMany($order_id_array);

        //get publication
        $pud_date = Carbon::tomorrow()->format('l');
        switch($pud_date){
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
        //get total
        $total = $batch->get_totals($printOrder);
        
        //dd($total);
        $routes = Route::all();
        $batch_id = $printOrder;
        $pdf = PDF::loadView('printorders.pdf', compact('batch_id', 'orders', 'date','pub', 'code', 'total', 'routes', 'total'));
        return $pdf->download('test.pdf');
        return view('printorders.show', compact('batch_id', 'orders', 'date','pub', 'code', 'total', 'routes', 'total'));
    }

    public function approve($printOrder){
        //check if entry exists in print_order_verify
        $entry = \DB::table('print_order_verify')->where('batch_id', $printOrder)->get();
        if($entry->isEmpty()){
            //create new entry and return to display view
            \DB::table('print_order_verify')->insert(['batch_id'=>$printOrder, 'created_at'=>Carbon::now()->format('Y-m-d h:s:i'), 'updated_at'=>Carbon::now()->format('Y-m-d h:s:i')]);
        }
        //get verification entry
        $entry = \DB::table('print_order_verify')->where('batch_id', $printOrder)->get();
        //return view showing status
        //get total
        $order = new PrintOrder;
        $total = $order->get_totals($printOrder);
        //dd($entry);
        //publication
        $day = Carbon::now()->format('l');
        $pub = $order->get_pub($day);
        return view('printorders.approval', compact('entry','total', 'pub'));
    }

    public function approve_process(Request $request){
        //check who submitted approval, and make change to database
        $user = $request->user;
        switch($user){
            case "sales_exec":
            \DB::table('print_order_verify')->where('batch_id', $request->batch_id)->update([$user => true, 'first_sub'=>Carbon::now()->format('Y-m-d h:s:i')]);
            break;
            case "dist_mgr":
            \DB::table('print_order_verify')->where('batch_id', $request->batch_id)->update([$user => true, 'second_sub'=>Carbon::now()->format('Y-m-d h:s:i')]);
            break;
            case "dc":
            \DB::table('print_order_verify')->where('batch_id', $request->batch_id)->update([$user => true, 'third_sub'=>Carbon::now()->format('Y-m-d h:s:i')]);
            break;
            case "finance":
            \DB::table('print_order_verify')->where('batch_id', $request->batch_id)->update([$user => true, 'fourth_sub'=>Carbon::now()->format('Y-m-d h:s:i')]);
            break;
        }
        return redirect('/printorders');
    }
}
