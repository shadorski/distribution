@extends('layouts.master')

@section('content')
<h1>Details : </h1>
<form class="" method="POST" action="/products">
{{ csrf_field() }}
	<div class="form-group">
		<label class="">Product</label>
		<input type="text" class="form-control" id="productName" name="productName" value="">
	</div>
	<div class="form-group">
		<label>Price</label>
		<input type="text" class="form-control" id="price" name="price">
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-outline-primary btn-lg">Submit</button>
	</div>
</form>

@endsection