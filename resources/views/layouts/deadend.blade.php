@extends('layouts.master')

@section('content')
	<div class="alert alert-danger" role="alert">
		<h1 class="alert-heading">Ooops! :(</h1>
		<h2>{{ $error }}</h2>

		<p align="center">
		<a class="btn btn-outline-success btn-lg" href="/">Home</a>
		</p>
	</div>
@endsection