<div id="accordian" role="tablist">
@foreach($routes as $route)

	<div class="card">
		<div class="card-header" role="tab" id="{{$route->id}}">
			<h5 class="mb-0">
				<a data-toggle="collapse" href="#{{$route->route}}" aria-expanded="true" aria-controls="{{$route->route}}">
				{{ $route->route}} <b class="close">{{ count($route->customer) }}</b>
				</a>
			</h5>
		</div>

		<div id="{{$route->route}}" class="collapse " role="tabpanel" aria-labelledby="{{$route->id}}" >
			<div class="card-body">
			<ul>
			@foreach($route->customer as $customer)
				<li><a href="/customers/{{$customer->id}}">{{ $customer->customer_name }}</a></li>
			@endforeach
			</ul>
			</div>
		</div>
	</div>

@endforeach
</div>
