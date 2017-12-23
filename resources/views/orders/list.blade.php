@extends('layouts.master')
@section('content')
    

    <div class="row">
    	<div class="col-md-8">
            @if($customers->count() >= 1)
            <h1>Create Order : </h1>
    		<h3>Select Customer</h3>
    		<table class="table">
    		<tbody>
				@foreach ($customers as $customer)
					<tr><td>{{ $customer->customer_name }}</td><td><a class="btn btn-outline-success btn-lg" href="/orders/create/{{$customer->id}}">Select</a></td></tr>
				@endforeach
				</tbody>
			</table>
    		@else
            <h2>All customers already have orders</h2>
            @endif
    	</div>
    </div>
    
    
@endsection
