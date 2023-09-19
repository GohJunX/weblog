@extends('layouts.app')

@section('content')
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            background-color: #f5f5f5;
        }

        .container {
            margin-top: 40px;
        }

        .btn-details {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .button-top .btn-post-job {
            margin-top: 100px;
            position: absolute;
            top: 10px;
            right: 150px;
        }

        .job-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .job-box h2 {
            margin-top: 0;
        }

        .card-text {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1; /* Adjust the number of lines you want to show */
        width:50%;
        overflow: hidden;
        text-overflow: ellipsis;
        }

    </style>
</head>
<div class="container" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5); margin-top:25px;">
    <h1>Job Post Home Page</h1>

    <div class="row" >
        <div class="col-md-12">
        @if($jobs->where('job_ver', 0)->count() > 0)
            <div class="job-box" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <h2>Job Unverified</h2>
                @foreach($jobs as $job)
                @if($job->job_ver == 0)
                <div class="card mb-4" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->jp_pos }}</h5>
                        <p class="card-text">{{ $job->jp_des }}</p>
                        <a href="{{ route('employerDetail.show', $job->jp_id) }}" class="btn btn-primary btn-details" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">View Details</a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            @endif

            <div class="job-box" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <h2>Job Verified</h2>
                @foreach($jobs as $job)
                @if($job->job_ver == 1)
                <div class="card mb-4" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->jp_pos }}</h5>
                        <p class="card-text">{{ $job->jp_des }}</p>
                        <a href="{{ route('employerDetail.show', $job->jp_id) }}" class="btn btn-primary btn-details" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">View Details</a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

          
        </div>
    </div>

    <div class="button-top">
        <a href="{{ route('employerCreate.show') }}" class="btn btn-success btn-post-job" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">Post a Job</a>
    </div>
</div>
@endsection
