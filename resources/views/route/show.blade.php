@extends('layouts.master')

@section('content')
	<script>
		function delRoute(){
			$('#form_delete').submit();
		}
	</script>
    <h1>Route</h1>
    	<p>{{ $route->route }} Route</p>
    	<p>{{ $route->description }}</p>
    	<a class="btn btn-outline-primary btn-lg" href="/routes/{{$route->id}}/edit">Edit</a>
    	<button class="btn btn-outline-danger btn-lg" id="delRoute" name="delRoute" onClick="delRoute()">Delete</button>
    	<button class="btn btn-outline-warning btn-lg" id="disCustomer" name="disCustomer">Disable</button>
    	<form method="POST" action="/routes/{{$route->id}}" id="form_delete" name="form_delete">
    		{{csrf_field()}}
    		{{method_field('DELETE')}}
    	</form>
@endsection

