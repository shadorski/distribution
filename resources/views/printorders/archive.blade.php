
@if($old_print_orders <> null)
	@foreach($old_print_orders as $old_print_order)
            <div class="row">
                <div class="card" style="width:20rem">
                    @if($old_print_order->status == 0)
                    <div class="card-header bg-warning text-white">
                        Status : incomplete 
                    </div>
                    @else 
                    <div class="card-header bg-success text-white">
                        Status : complete
                    </div>
                    @endif 
                    <div class="card-body">
                        <h4 class="card-title">Batch No. @if(isset($old_print_order)) {{ $old_print_order->batch_id }} @endif</h4>
                            @php
                             $po = new App\PrintOrder;
                             
                             $id = $old_print_order->batch_id;
                             
                            @endphp

                        <h6 class="card-subtitle mb-2 text-muted">{{ $po->get_pub_date($id) }}</h6>
                        <p><b>Total : {{ $po->get_totals($id) }}</b></p>
                        <a href="/printorders/{{$old_print_order->batch_id}}" class="btn btn-outline-primary btn-lg">View</a>
                    </div>
                </div>
            </div><br>
    @endforeach
@else
	<b>No Old Print Orders</b>
@endif

