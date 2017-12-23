@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Customer Type</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach($customers as $customer)
                    <tr>
                        <th>{{$i}}</th>
                        <td>{{$customer->customer_name}}</td>
                        <td>{{$customer->address}}</td>
                        <td>{{$customer->phone_number}}</td>
                        <td>{{$customer->type_text}}</td>
                        <td><a href="/customers/{{$customer->id}}" class="btn btn-primary">View</a></td>
                    </tr>
                    @php

                    $i++;

                    @endphp
                @endforeach
                </tbody>
            </table>
            <h3>{{ $customers->links() }} </h3>
        </div>
    </div>

@endsection



