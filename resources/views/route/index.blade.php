@extends('layouts.master')

@section('content')
    <h1>Routes</h1>

    <div class="row">
    	<div class="col-md-6">
    		<h3>Options</h3>
    		<a href="/routes/create" class="btn btn-outline-primary btn-lg">Create</a>
    	</div>
    	<div class="col-md-6">
    		<div class="row">
    			<div class="col-md-6">
    			<h3>Active Routes</h3>
                    @if($routes->isEmpty())
                        <b>No Routes!</b>
                    @else
                        <ul>
                        @foreach($routes as $route)
                       <li><a href="/routes/{{ $route->id }}">  {{ $route->route }} </a></li>
                        @endforeach
                        </ul>
                    @endif
                
    			</div>
    		</div>
    	</div>
    </div>
    
    
@endsection
