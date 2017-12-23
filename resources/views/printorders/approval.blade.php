@extends('layouts.master')

@section('content')

@php
	$status = 'warning';
	$status_message = 'incomplete';
	$submission1 = null;
	$submission2 = null;
	$submission3 = null;
	$submission4 = null;
	$data = null;
	$sales = "sales_exec";
	$dm = "dist_mgr";
	$dc = "dc";
	$finance = "finance";
	foreach($entry as $e){
		$data = $e;
	}

	if($data->sales_exec != false){
		$status = 'success';
		$status_message = 'complete';
		$submission1 = $data->first_sub;
	}
@endphp

	<h1>Print Order - {{$data->batch_id}}</h1> <h2>Approval Status</h2>

	<div class="row">
		<form class="form" method="POST" action="/printorders/approve/{{$data->batch_id}}">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<input type="hidden" value="{{ $sales }}" id="user" name="user" />
			<input type="hidden" value="{{ $data->batch_id }}" id="batch_id" name="batch_id" />
			<div class="card" style="width:17rem">
		        <div class="card-header bg-{{$status}} text-white">
		            Status : {{$status_message}} 
		        </div>
		        <div class="card-body">
			        <h4 class="card-title">Sales Executive</h4>
			        <h6 class="card-subtitle mb-2 text-muted">Submitted : {{$submission1}}</h6>
			        @if($submission1 == null)
			        	<div align="center"><button class="btn btn-outline-primary btn-lg">Approve</button></div>
			        @endif
		        </div>
		    </div>
		</form>
		@php
			$status = 'warning';
			$status_message = 'incomplete';
			if($data->dist_mgr != false){
				$status = 'success';
				$status_message = 'complete';
				$submission2 = $data->second_sub;
			}
		@endphp
		<form class="form" method="POST" action="/printorders/approve/{{$data->batch_id}}">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<input type="hidden" value="{{ $dm }}" id="user" name="user" />
			<input type="hidden" value="{{ $data->batch_id }}" id="batch_id" name="batch_id" />

			<div class="card" style="width:18rem">
		        <div class="card-header bg-{{$status}} text-white">
		            Status : {{$status_message}} 
		        </div>
		        <div class="card-body">
			        <h4 class="card-title">Distribution Manager</h4>
			        <h6 class="card-subtitle mb-2 text-muted">Submitted : {{$submission2}}</h6>
			        @if($submission2 == null)
			        	<div align="center"><button class="btn btn-outline-primary btn-lg">Approve</button></div>
			        @endif
		        </div>
		    </div>
		</form>
		@php
			$status = 'warning';
			$status_message = 'incomplete';
			if($data->dc != false){
				$status = 'success';
				$status_message = 'complete';
				$submission3 = $data->third_sub;
			}
		@endphp
		<form class="form" method="POST" action="/printorders/approve/{{$data->batch_id}}">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<input type="hidden" value="{{ $dc }}" id="user" name="user" />
			<input type="hidden" value="{{ $data->batch_id }}" id="batch_id" name="batch_id" />

		    <div class="card" style="width:17rem">
		        <div class="card-header bg-{{$status}} text-white">
		            Status : {{$status_message}} 
		        </div>
		        <div class="card-body">
			        <h4 class="card-title">Director Commercial</h4>
			        <h6 class="card-subtitle mb-2 text-muted">Submitted : {{$submission3}}</h6>
			        @if($submission3 == null)
			        	<div align="center"><button class="btn btn-outline-primary btn-lg">Approve</button></div>
			        @endif
		        </div>
		    </div>
		</form>
		@php
			$status = 'warning';
			$status_message = 'incomplete';
			if($data->finance != false){
				$status = 'success';
				$status_message = 'complete';
				$submission4 = $data->fourth_sub;
			}
		@endphp
		<form class="form" method="POST" action="/printorders/approve/{{$data->batch_id}}">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}
			<input type="hidden" value="{{ $finance }}" id="user" name="user" />
			<input type="hidden" value="{{ $data->batch_id }}" id="batch_id" name="batch_id" />

		    <div class="card" style="width:17rem">
		        <div class="card-header bg-{{$status}} text-white">
		            Status : {{$status_message}} 
		        </div>
		        <div class="card-body">
			        <h4 class="card-title">Finance</h4>
			        <h6 class="card-subtitle mb-2 text-muted">Submitted : {{$submission4}}</h6>
			        @if($submission4 == null)
			        	<div align="center"><button class="btn btn-outline-primary btn-lg">Approve</button></div>
			        @endif
		        </div>
		    </div>
		</form>
	</div>
	<br/>
	<div class="row alert alert-dark" >
			<div class="col-md-6"><h1><b>{{$pub}}</b></h1></div>
			<div class="col-md-6"> <h1><b>Total : </b> {{$total}}</h1></div>
	</div>
	<br/>
	<div class="row">	
		<div class="col-md-6">
			<h2>Totals Per Route</h2>
		</div>
		<div class="col-md-6">
			<h2>Totals Per Customer Type</h2>
		</div>
	</div>
@endsection