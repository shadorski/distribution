@extends('layouts.master')

@section('content')
	<div class="row">
		<div class="col-md-6">
				<h2>Searched For : " {{$searchTerm}} "</h2>
				<h3>Matches found : {{$results->count()}} </h3>
		</div>
		<div class="col-md-6">
				<form class="form" method="POST" action="/customers/search">
                        {{csrf_field()}}
                    <div class="input-group input-group-lg">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="submit">Search Again</button>
                        </span>
                            <input type="text" id="srch" name="srch" class="form-control">
                    </div>
                </form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">

				<table class="table table-striped">
						<thead>
							<tr><td>Customer Name</td><td>Contact Person</td><td>Address</td></tr>
						</thead>
						@foreach($results as $result)
							<tr><td>{{$result->customer_name}}</td><td>{{$result->contact_person}}</td><td>{{$result->address}}</td><td><a href="/customers/{{ $result->id }}" class="btn btn-primary">View</a></td></tr>
						@endforeach
				</table>
		</div>
	</div>
	

@endsection