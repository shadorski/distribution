@extends('layouts.master')

@section('content')
    <h1>Edit Order : {{ $order->customer->customer_name }}</h1>
    <div class="col-md-8">
        <form  method="POST" action="/orders/{{ $order->id }}">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="hidden" name="customer_id" value="{{ $order->customer->id }}">
                <div class="row form-group">
                    <div class="col-md-2">
                        Daily Mail <input type="text" class="form-control" id="zdm01" name="zdm01" value="{{ $order->zdm01 }}" placeholder="Daily Mail">
                    </div>
                    <div class="col-md-3">
                    Daily Mail(Sat)<input type="text" class="form-control" id="zdm02" name="zdm02" value="{{ $order->zdm02 }}" placeholder="Daily Mail - Sat">
                    </div>
                    <div class="col-md-2">
                    Sunday Mail <input type="text" class="form-control" id="zdm03" name="zdm03" value="{{ $order->zdm03 }}" placeholder="Sunday Mail">
                    </div>
                    <div class="col-md-2">
                    ePaper <input type="text" class="form-control" id="zdm04" name="zdm04" value="{{ $order->zdm04 }}" placeholder="ePaper">
                    </div>
                </div>
                <div class="form-group">
            		<button type="submit" class="btn btn-primary">Save</button>
            	</div>
        </form>
        @include ('layouts.errors')
    </div>
    
@endsection
