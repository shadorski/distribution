@extends('layouts.master')

@section('content')
    <h1>Edit Route : </h1>
    <div class="col-md-8">
            <form class="form" method="POST" action="/routes/{{ $route->id }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
                <div class="form-group">
                    <label>Route</label>
                    <input type="text" class="form-control" id="route" name="route" placeholder="Route" value="{{ $route->route }}" />
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Route Description">{{ $route->description }}</textarea> 
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
           @include ('layouts.errors')
    </div>
    
@endsection