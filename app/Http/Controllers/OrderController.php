<?php

namespace App\Http\Controllers;
use Validator;
use App\Order;
use App\Customer;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        //show orders dashboard
        //get a join of customer and order
        $orders = Order::where('status', 1)->paginate(15);
        //dd($orders);
        return view('orders.index', compact('orders'));
    }

    public function list(){
        //get list of customers without orders
        $customers_with_orders = Order::pluck('customer_id')->all();
        $customers = Customer::whereNotIn('id',$customers_with_orders)->select('*')->get();
        //dd($customers);

         return view('orders.list', compact('customers'));
    }

    public function create(Customer $customer)
    {
        //show order creation form
        //check customer type [normal, vendor, agent] ----future feature
        //06092017 -- focus on generating print order and saving it for the purpose of presentation

         return view('orders.create', compact('customer'));
    }

    
    public function store(Request $request)
    {
        //create new order
        //validate request data
        //$this->validate(request(),['zdm01'=>'required|integer', 'zdm02'=>'required|integer', 'zdm03'=>'required|integer', 'zdm04'=>'required|integer']);
        $rules = array('zdm01'=>'required_without_all:zdm02, zdm03|min:1', 'zdm02'=>'required_without_all:zdm01, zdm03|min:1', 'zdm03'=>'required_without_all:zdm02, zdm01|min:1');
        $validator = validator::make(request()->all(), $rules)->validate();
        //get customer instance
        $customer = Customer::find(request('customer_id'));
        //save order to database
        //start date - tomorrow
        $start = Carbon::tomorrow();
        $start1 = Carbon::tomorrow();
        //end date - tomorrow + 1 year
        $end = $start1->addDays(365);
        
        Order::create(['customer_id'=>request('customer_id'), 'zdm01'=>request('zdm01'), 'zdm02'=>request('zdm02'), 'zdm03'=>request('zdm03'), 'zdm04'=>request('zdm04'), 'transport'=>false, 'start_date'=>$start, 'end_date'=>$end, 'status'=>true]);

        //go to another page
        return redirect('/orders');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //get specified order and subsiquest customer details
        //$pdf = PDF::loadView('orders.show', compact('order'));
        //return $pdf->download('test.pdf');
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        //
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //validate the input
        $rules = array('zdm01'=>'required_without_all:zdm02, zdm03|min:1', 'zdm02'=>'required_without_all:zdm01, zdm03|min:1', 'zdm03'=>'required_without_all:zdm02, zdm01|min:1');
        $validator = validator::make(request()->all(), $rules)->validate();
        //update process will currently invlove disabling the old order and create a new one. This means disabled orders should not be visible on the process level
        $order->update(['status'=>false]);
        //get old dates 
        $start = $order->start_date;
        $end = $order->end_date;
        //now create a new order with the details entered
        $order = Order::create(['customer_id'=>request('customer_id'), 'zdm01'=>request('zdm01'), 'zdm02'=>request('zdm02'), 'zdm03'=>request('zdm03'), 'zdm04'=>request('zdm04'), 'transport'=>false, 'start_date'=>$start, 'end_date'=>$end, 'status'=>true]);

        return view('orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //disaable order
        $order->update(['status'=>false]);
        return redirect('/orders');
    }
}
