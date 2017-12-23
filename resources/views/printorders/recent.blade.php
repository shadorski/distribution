@if($batch <> null)
	<div class="card" style="width:20rem">
    	@if($batch->status == 0)
        <div class="card-header bg-warning text-white">
            Status : incomplete 
        </div>
        @else 
        <div class="card-header bg-success text-white">
            Status : complete
        </div>
        @endif 
        <div class="card-body">
	        <h4 class="card-title">Batch No. @if(isset($batch)) {{ $batch->batch_id }} @endif</h4>
	        <h6 class="card-subtitle mb-2 text-muted">{{ $pub }}</h6>
	        <p><b>Total : </b>{{ $total }}</p>
	        <a href="/printorders/{{$batch->batch_id}}" class="btn btn-outline-primary btn-lg">View</a>
            <a href="/printorders/edit/{{$batch->batch_id}}" class="btn btn-outline-success btn-lg">Edit</a>
            
        @if($batch->status == 0)<a href="/printorders/approve/{{$batch->batch_id}}" class="btn btn-danger btn-lg">Approve</a>@endif
        </div>
    </div>
@else
	<a class="btn btn-outline-primary btn-lg" href="/printorders/create">New Print Order</a>
@endif