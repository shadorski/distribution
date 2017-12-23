@extends('layouts.master')

@section('content')
    <h1>Customers</h1>
    <div class="row">
    	<div class="col-md-6">
            <h3>Active</h3>
            <div class="row">
                <div class="col-md-12">
                @php
                    $agent = "n/a";
                    $subscribers = "n/a";
                    $vendors = "n/a";
                    $presales = "n/a";
                    $free = "n/a";
                    $staff = "n/a";
                    $epaper = "n/a";
                

                foreach($customer_types as $type){
                    switch($type->type){
                        case "Agent":
                            $agent = $type->total_types;
                        break;
                        case "Vendors":
                            $vendors = $type->total_types;
                        break;
                        case "Subscribers":
                            $subscribers = $type->total_types;
                        break;
                        case "Presales":
                            $presales = $type->total_types;
                        break;
                        case "Free":
                            $free = $type->total_types;
                        break;
                        case "Staff":
                            $staff = $type->total_types;
                        break;
                        case "epaper":
                            $epaper = $type->total_types;
                        break;
                        default:

                        break;
                    }
                }
                
                @endphp
                        
                    <a class="btn btn-outline-primary btn-lg" href="/customers/type/subscribers">Subscribers <br> <span class="badge badge-dark">{{$subscribers}}</span></a>
                    <a class="btn btn-outline-secondary btn-lg" href="/customers/type/agents">Agents <br> <span class="badge badge-dark">{{$agent}}</span></a>
                    <a class="btn btn-outline-success btn-lg" href="/customers/type/vendors">Vendors <br> <span class="badge badge-dark">{{$vendors}}</span></a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                        <a class="btn btn-outline-danger btn-lg" href="/customers/type/presales">Pre Sales <br> <span class="badge badge-dark">{{$presales}}</span></a>
                        <a class="btn btn-outline-info btn-lg" href="/customers/type/free">Free Copies <br> <span class="badge badge-dark">{{$free}}</span></a>
                        <a class="btn btn-outline-dark btn-lg" href="/customers/type/staff">Staff <br> <span class="badge badge-dark">{{$staff}}</span></a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                        <a class="btn btn-outline-warning btn-lg" href="/customers/type/epaper">ePaper <br> <span class="badge badge-dark">{{$epaper}}</span></a>
                </div>
            </div>
    	</div>
        <div class="col-md-6">
            <h3>Options</h3>
            <div class="row">
                <div class="col-md-6">
                    <a href="/customers/create" class="btn btn-outline-primary btn-lg">Create</a>
                    <a href="/customers/list" class="btn btn-outline-warning btn-lg">View</a>
                </div>
                <div class="col-md-6">
                    <form class="form" method="POST" action="/customers/search">
                        {{csrf_field()}}
                    <div class="input-group input-group-lg">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="submit">Search</button>
                        </span>
                            <input type="text" id="srch" name="srch" class="form-control">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
@endsection

