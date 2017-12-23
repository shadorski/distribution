<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Route;
use App\Order;

class CustomerController extends Controller
{
    
    public function index()
    {
        // GET /customers
        $customers = Customer::latest()->get();
        $routes = Route::all();
        //dd($routes);
        //$customers = DB::table('customers')->get();
        //return $customers;
        //get customer type, and totals
        $customer_types = \DB::table('customer_type')->selectRaw('customer_type.type, count(customers.customer_type) as total_types')->rightjoin('customers', 'customer_type.id', '=', 'customers.customer_type')->groupBy('customer_type.id', 'customer_type.type')->get();
        //dd($customer_types);
        return view('customers.index', compact('customers', 'routes','customer_types'));
    }

    public function create()
    {
        // GET /customers/create
        $routes = Route::all();
        $customer_types = \DB::table('customer_type')->get();
        return view('customers.create', compact('routes', 'customer_types'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $this->validate(request(),['customerName'=>'required', 'contactPerson'=>'required', 'address'=>'required', 'email'=>'required']);
        //$customer = new Customer;
        //POST /customers
        //request data
        
        //$customer->customer_name = request('customerName');
        //$customer->contact_person = request('contactPerson');
        //$customer->customer_type = request('customerType');
        //$customer->phone_number = request('phoneNumber');
        //$customer->address = request('address');
        //$customer->postal = request('postal');
        //$customer->email = request('email');
        //$customer->route = request('route');

        Customer::create(['customer_name'=>request('customerName'), 'contact_person'=>request('contactPerson'), 'email'=>request('email'), 'postal'=>request('postal'), 'address'=>request('address'), 'phone_number'=>request('phoneNumber'), 'route'=>request('route'), 'customer_type'=>request('customerType')]);
        //$customer->status = true;

        //save to database
        //$customer->save();

        //redirect to customer page
        return redirect('/customers');
    }

    
    public function show(Customer $customer)
    {
        //dd($customer);
        $customer_type = \DB::table('customer_type')->where('id',$customer->customer_type)->first();
        
        //dd($customer_type);
        $route = Route::find($customer->route);
        return view('customers.show', compact('customer', 'customer_type', 'route'));
    }

    
    public function edit(Customer $customer)
    {
        //
        $routes = Route::all();
        $selected = "";
        $customer_types = \DB::table('customer_type')->get();
        //dd($customer_types);
        return view('customers.edit', compact('customer', 'routes', 'selected', 'customer_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            //dd($request);
        //update customer record
        //validate input
        $customer = Customer::find($id);
        $this->validate(request(),['customerName'=>'required', 'contactPerson'=>'required', 'address'=>'required', 'email'=>'required']);
        //data transaction
        $customer->update(['customer_name'=>request('customerName'), 'contact_person'=>request('contactPerson'), 'email'=>request('email'), 'postal'=>request('postal'), 'address'=>request('address'), 'phone_number'=>request('phoneNumber'), 'route'=>request('route'), 'customer_type'=>request('customerType')]);
        
        //return view('customers.show', compact('customer'));
        return $this->show($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete customer record
        //confirm delete
        $customer = Customer::find($id);
        if($customer <> null){
             //first copy data to deleted customer table
            \DB::table('deleted_customers')->insert(['customer_name'=>$customer->customer_name, 'contact_person'=>$customer->contact_person, 'email'=>$customer->email, 'postal'=>$customer->postal, 'address'=>$customer->address, 'phone_number'=>$customer->phone_number, 'route'=>$customer->route, 'customer_type'=>$customer->customer_type, 'customer_id'=>$customer->id]);
            //disable active orders
            $order = new Order;
            $order->where('customer_id', $id)->update(['status'=>false]);
            //now delete customer
            $customer->delete();
            return redirect('/customers');
        }else{
            //404
            return view('layouts.deadend', ['error'=>'Seems what you are trying to delete has already been deleted!']);
        }
        
    }

    public function customer_type($type)
    {
        //get list of subscribers
        //dispaly to appropriat view.
        $type_id = \DB::table('customer_type')->where('type', $type)->pluck('id');
        $customers = \DB::table('customers')->where('customer_type', $type_id)->paginate(15);
        return view('customers.type', compact('customers'));
        //dd($customers);
    }

    public function search(Request $request){
        $this->validate(request(),['srch'=>'required|min:2']);
        $searchTerm = request('srch');
        $customer = new Customer;
        $results = $customer->search($searchTerm);
        return view('customers.results', compact('results', 'searchTerm'));
    }

    public function list(){
        $customers = Customer::rightJoin('customer_type', 'customer_type.id', '=', 'customers.customer_type')->orderBy('customers.id', 'asc')->paginate(15);
        //dd($customers);
        return view('customers.list', compact('customers'));
    }
}

