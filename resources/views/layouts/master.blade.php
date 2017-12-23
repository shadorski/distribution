<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Distribution</title>
		<link href="{{asset('css/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">		
		<link href="{{asset('css/bootstrap/css/navbar-top-fixed.css')}}" rel="stylesheet">		
	</head>
	<body>
	@include('layouts.nav')
		<div class='container'>
			@yield('content')		
		</div>
		<script src="{{asset('css/bootstrap/js/jquery-3.2.1.slim.min.js')}}"></script>
		<script src="{{asset('css/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{asset('css/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{asset('css/bootstrap/js/jasny-bootstrap.min.js')}}"></script>
	</body>
	<footer>
		
	</footer>
</html>