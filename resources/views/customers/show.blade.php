@extends('layouts.master')

@section('content')
	<div class="row">
        <div class="col-md-6">
            <table class="table">
                <tr><td>Name</td><td>{{$customer->customer_name}}</td></tr>
                <tr><td>Contact Person</td><td>{{$customer->contact_person}}</td></tr>
                <tr><td>Address</td><td>{{$customer->address}}</td></tr>
                <tr><td>Type</td><td>{{$customer_type->type_text}}</td></tr>
                <tr><td>Route</td><td>{{$route->route_text}}</td></tr>
            </table>

            
            <form class="form" method="post" action="/customers/{{$customer->id}}">
                {{csrf_field()}}
                {{ method_field('DELETE') }}
                <a class="btn btn-outline-warning btn-lg" href="/customers/{{$customer->id}}/edit">Edit</a> <button class="btn btn-outline-dark btn-lg" type="submit">Delete</button>
                
            </form>
        </div>
    </div>
@endsection

