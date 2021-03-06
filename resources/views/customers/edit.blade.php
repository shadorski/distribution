@extends('layouts.master')

@section('content')
    <h1>Edit Customer : </h1>
    <div class="col-md-8">
            <form class="form" method="POST" action="/customers/{{$customer->id}}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}

            	<div class="form-group">
            		<label>Customer Name</label>
            		<input type="text" class="form-control" id="customerName" name="customerName" placeholder="Customer Name" value="{{$customer->customer_name}}" />
            	</div>
            	<div class="form-group">
            		<label>Contact Person</label>
            		<input type="text" class="form-control" id="contactPerson" name="contactPerson" placeholder="Contact Person" value="{{$customer->contact_person}}">
            	</div>
                <div class="form-group">
                    <label>Customer Type</label>
                    <select class="form-control col-md-3" id="customerType" name="customerType">
                        @if($customer_types->isEmpty())
                            <option>No Customer Types!</option>
                        @else
                                @foreach($customer_types as $type)
                                    @php
                                        if($type->ID == $customer->customer_type){
                                            $selected = "selected";
                                        }
                                    @endphp
                                    <option {{ $selected }} value="{{ $type->ID }}">  {{ $type->type_text }} </option>
                                    @php
                                        $selected = "";
                                    @endphp
                                @endforeach
                        @endif
                    </select>
                </div>
            	<div class="form-group">
            		<label>Phone Number</label>
            		<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" value="{{$customer->phone_number}}">
            	</div>
            	<div class="form-group">
            		<label>Physical Address</label>
            		<input type="text" class="form-control" id="address" name="address" placeholder="Physical Address" value="{{$customer->address}}">
            	</div>
            	<div class="form-group">
            		<label>Postal</label>
            		<input type="text" class="form-control" id="postal" name="postal" placeholder="Postal" value="{{$customer->postal}}">
            	</div>
                <div class="form-group">
                    <label>Route</label>
                    <select class="form-control col-md-4" id="route" name="route">
                        @if($routes->isEmpty())
                            <option>No Routes!</option>
                        @else
                                
                                @foreach($routes as $route)
                                    @php
                                        if($route->id == $customer->route){
                                            $selected = "selected";
                                        }
                                    @endphp
                                    <option {{ $selected }} value="{{ $route->id }}">  {{ $route->route }} </option>
                                    @php
                                        $selected = "";
                                    @endphp
                                @endforeach
                           
                        @endif
                    </select>
                </div>
            	<div class="form-group">
            		<label>Email</label>
            		<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{$customer->email}}">
            	</div>
            	<div class="form-group">
            		<button type="submit" class="btn btn-primary">Save</button>
            	</div>
            </form>
           @include ('layouts.errors')
    </div>
    
@endsection
