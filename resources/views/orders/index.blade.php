@extends('layouts.master')

@section('content')
	<h1>Orders : </h1>
	<div class="row">
    	<div class="col-md-6">
    		<h3>Options</h3>
    		<a href="/orders/create/list" class="btn btn-outline-primary btn-lg">Create</a>
    	</div>
    	<div class="col-md-6">
            <div class="row">
        		<div class="col-md-6">
        		  <h3>Active Orders</h3>
        		  <table class="table">
                    <thead><td>Order No. </td><td>Customer</td></thead>
                    @foreach($orders as $order)
                    <tr>
                        <td><b>{{ $order->id }}</b></td><td><a href="/orders/{{$order->id}}">{{$order->customer->customer_name}}</a></td>
                    </tr> 
                    @endforeach     
                  </table>	
        		</div>
    		</div>
            <div class="row">
                <div class="col-md-6">
                <h3> {{ $orders->links() }} </h3>
                </div>
            </div>
    	</div>
    </div>
@endsection