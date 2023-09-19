@extends('layouts.appAdmin')

@section('content')

<style>
     body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }
</style>

<div class="container">
    <div class="card">
        <div class="card-body">
            <h1 class="card-title mb-4">{{$companies->name}}</h1>

            <p class="card-text"><strong>Email:</strong> {{$companies->email}} </p>
            <p class="card-text"><strong>Location:</strong> {{$companies->u_location}} </p>
            <p class="card-text"><strong>Phone-No:</strong> {{$companies->u_phone_number}} </p>

            <div class="mt-4 border-top pt-4">
                <h3>Company Description:</h3>
                <div class="card p-3">
                    <p class="card-text">{{$companies->u_desc}}</p>
                </div>
            </div>

            <div class="mt-4">
                <form action="{{ route('admin.verify.approve',$companies->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
                <form action="{{ route('admin.verify.reject',$companies->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Reject</button>
                </form>
            </div>

            <button onclick="history.back()" class="btn btn-secondary mt-4 float-end">Back</button>
        </div>
    </div>
</div>
@endsection