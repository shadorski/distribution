@extends('layouts.master')

@section('content')
	<h1>Print Orders</h1>
	<div class="row">
    	<div class="col-md-6">
            <h3>Recent</h3>
            @include ('printorders.recent')
        </div>
        <div class="col-md-6">
            <h3>Archives</h3>
            @include ('printorders.archive')
        </div>
    </div>
@endsection