@extends('layouts.master')

@section('content')
	<script>
		function delProduct(){
			$('#form_delete').submit();
		}
		
	</script>
    <h1>Product Summary</h1>
    
    	<p>{{ $product->product_name }}</p>
    	<p><b>ZMK</b> {{ $product->price }}</p>

    	<a class="btn btn-outline-primary btn-lg" href="/products/{{$product->id}}/edit">Edit</a>
    	<button class="btn btn-outline-danger btn-lg" id="delCustomer" name="delCustomer" onClick="delProduct()">Delete</button>
    	<button class="btn btn-outline-warning btn-lg" id="disCustomer" name="disCustomer">Disable</button>
    	

    	<form method="POST" action="/products/{{$product->id}}" id="form_delete" name="form_delete">
    		{{csrf_field()}}
    		{{method_field('DELETE')}}
    	</form>
@endsection
