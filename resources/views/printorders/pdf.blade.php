<h1>Print Order <b>for</b> {{ $date }}  - {{ $pub }}</h1>
<table class="table">
@foreach($routes as $route)
    <tr><td>Route </td><td>{{ $route->route }}</td><td></td></tr>
    @foreach($route->customer as $customer)
        <tr><td></td><td><li>{{ $customer->customer_name}}</li></td><td>@foreach($customer->order as $order) {{ $order->$code }} @endforeach</td></tr>
    @endforeach
@endforeach
</table>
<h1>Total : {{$total}}</h1>