@extends('layouts.master')

@section('content')
	<script>
		function delOrder(){
			$('#form_delete').submit();
		}
		
	</script>

    <h1>Order No. {{ $order->id }}</h1>
    <h1>Customer : {{ $order->customer->customer_name }}</h1>

    <table class="table">
        <thead>
            <td>Publication</td><td>Qty</td>
        </thead>
        <tr>
            <td>Daily Mail</td><td>{{ $order->zdm01 }}</td>
        </tr>
        <tr>
            <td>Daily Mail - Saturday</td><td>{{ $order->zdm02 }}</td>
        </tr>
        <tr>
            <td>Sunday Mail</td><td>{{ $order->zdm03 }}</td>
        </tr>
        <tr>
            <td>ePaper</td><td>{{ $order->zdm04 }}</td>
        </tr>
    </table>
    
    <a class="btn btn-outline-primary btn-lg" href="/orders/{{$order->id}}/edit">Edit</a>
    <button class="btn btn-outline-danger btn-lg" id="delCustomer" name="delCustomer" onClick="delCustomer()">Delete</button>
    	
    <form method="POST" action="/orders/{{$order->id}}" id="form_delete" name="form_delete">
    	{{csrf_field()}}
    	{{method_field('DELETE')}}
    </form>
@endsection
