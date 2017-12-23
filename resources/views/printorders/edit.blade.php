@extends('layouts.master')

@section('content')
    <h1>Print Order <b>for</b> {{ $date }}  - {{ $pub }}</h1>
    <form class="form" method="POST" action="/printorders">
    <input type="hidden" id="batch_id" name="batch_id" value="{{$batch_id}}">
    	{{ csrf_field() }}
    <div class="row">
		<table class="table">
		@foreach($routes as $route)
		    <tr><td>Route </td><td>{{ $route->route_text }}</td><td></td></tr>
		    @foreach($route->customer as $customer)
		        <tr><td></td><td>{{ $customer->customer_name }}</td><td colspan="1">@foreach($customer->order as $order) <input type="text" id="{{ $order->id }}" name="{{ $order->id }}" value="{{ $order->$code }}" class="form-control-lg" > @endforeach</td></tr>
		    @endforeach
		@endforeach

		</table>
	</div>
	<div class="row">
		<button class="btn btn-outline-success btn-lg">Submit</button>
	</div>
	</form>
@endsection