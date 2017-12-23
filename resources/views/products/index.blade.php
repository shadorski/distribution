@extends('layouts.master')

@section('content')
	<h1>Zambia Daily Mail Newsprint Products : </h1>
	<div class="row">
    	<div class="col-md-6">
    		<h3>Options</h3>
    		<a href="/products/create" class="btn btn-outline-primary btn-lg">Create</a>
    	</div>
    	<div class="col-md-6"><div class="row">
    		<div class="col-md-6">
    		<h3>Products</h3>
    			<ul>
				    @foreach ($products as $product)
				    	<li><a href="/products/{{$product->id}}">{{ $product->product_name }}</a></li>
				    @endforeach
			    </ul>
    		</div>
    		</div>
    	</div>
    </div>
@endsection