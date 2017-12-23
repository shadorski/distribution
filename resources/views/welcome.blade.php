
@extends('layouts.master')

@section('content')
    <h1>Dashboard</h1>
    	<div class="row">
    		<div class="col-md-3">
            <a href="/customers">customers</a>
            </div>
            <div class="col-md-3">
            <a href="/products">products</a>
            </div>
            <div class="col-md-3">
            <a href="/orders">orders</a>
            </div>
            <div class="col-md-3">
            <a href="/printorders">print orders</a>
            </div>
    	</div>
    </div>

@endsection

