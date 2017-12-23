@extends('layouts.master')

@section('content')
    <h1>Create Route : </h1>
    <div class="col-md-8">
            <form class="form" method="POST" action="/routes">
            {{ csrf_field() }}
                <div class="form-group">
                    <label>Route</label>
                    <input type="text" class="form-control" id="route" name="route" placeholder="Route" value="" />
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Route Description"></textarea> 
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
           @include ('layouts.errors')
    </div>
    
@endsection
