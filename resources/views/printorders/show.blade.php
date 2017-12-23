@extends('layouts.master')

@section('content')
    <h1>Print Order <b>for</b> {{ $date }}  - {{ $pub }}</h1>
<table class="table">
@foreach($routes as $route)
    <tr><td>Route </td><td>{{ $route->route }}</td><td></td></tr>
    @foreach($route->customer as $customer)
        <tr><td></td><td><li>{{ $customer->customer_name}}</li></td><td>@foreach($customer->order as $order) {{ $order->$code }} @endforeach</td></tr>
    @endforeach
@endforeach
</table>
<p text-align="right"><h1>Total : {{$total}}</h1></p>
	<a href="/printorders/edit/{{$batch->batch_id}}" class="btn btn-outline-primary btn-lg">Edit</a>
	<a href="/printorders/print/{{$batch->batch_id}}" class="btn btn-outline-info btn-lg">Print</a>
@endsection
