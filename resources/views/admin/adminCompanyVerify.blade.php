@extends('layouts.appAdmin')

@section('content')

<style>
     body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }
</style>
    <div class="container" style=" box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);padding-top:10px">
        <h1 class="mb-4">Company Verify</h1>

        <div class="row" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
           @foreach($companies as $company)
                <div class="col-md-6 mb-4" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);">
                    <div class="card">
                        <div class="card-body">
                        <h3 class="card-title">{{ $company->name }}</h3>
                            <p class="card-text">Email: {{ $company->email }}</p>
                            <p class="card-text">Location: {{ $company->u_location }}</p>
                            <p class="card-text">Apply Date: {{ $company->created_at }}</p>
                            <a href="{{ route('admin.verify.show', $company->id) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection