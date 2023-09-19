@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <style>
       body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .action-buttons {
            text-align: right;
            margin-bottom: 20px;
        }

        .apply-button,
        .close-icon {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .apply-button:hover,
        .close-icon:hover {
            background-color: #555;
        }

        .spacer {
            height: 20px;
        }

        .job-detail {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .job-description {
            background-color: #f9f9f9;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        h1,
        h2 {
            margin: 0;
            font-weight: bold;
        }

        p {
            margin: 0;
            margin-bottom: 10px;
        }

        .im-v {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .im-v .image-container,
        .im-v .video-container {
            flex: 1;
        }

        .im-v img,
        .im-v video {
            max-width: 100%;
            height: auto;
            display: block;
        }
        .job-detail {
    position: relative;
    max-width: 100%; /* Limit the width of job-detail */
}

.job-image {
    position: absolute;
    top: 0;
    right: 0;
    max-width: 100%; /* Limit the width of the image */
    height: auto; /* To maintain aspect ratio */
    margin: 10px; /* Adjust the margin as needed */
}

.job-info {
    margin-left: 15px; /* Adjust the margin as needed */
}
    </style>
</head>
<body>
<div class="container">
    <div class="action-buttons">
        <a href="{{route('applyJobForm',$job->jp_id)}}" class="apply-button">Apply Now</a>
        <a onclick="window.history.back()" class="close-icon">&times;</a>
    </div>

    <div class="spacer"></div>

    <div class="job-detail">

    <div class="job-image">
        @if($job->user->u_profile_pic)
            @if (file_exists(public_path(trim($job->user->u_profile_pic))))
                <img class="job-img" src="{{ asset(trim($job->user->u_profile_pic)) }}" alt="Job Image" width="150">
            @endif
        @endif
    </div>
       
        <h2>{{ $job->jp_pos }}</h2>
        <br>
        <p class="job-info"><i class="fas fa-building"></i> <strong>Company Name:</strong><a href="/profileEmp/show/{{$job->user->id}}"> {{$job->user->name}}</a></p>
        <p class="job-info"><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $job->jp_location }}</p>
        <p class="job-info"><i class="fas fa-map-marker"></i> <strong>Address:</strong> {{ $job->user->u_location }}</p>
        <p class="job-info"><i class="fas fa-money-bill-wave"></i> <strong>Salary:</strong> {{ $job->jp_salary }}</p>
        <p class="job-info"><i class="fas fa-briefcase"></i> <strong>Role:</strong> {{ $job->jp_pos }}</p>
        <p class="job-info"><i class="fas fa-clock"></i> <strong>Full or Part:</strong> {{ $job->jp_fulltime_parttime }}</p>

        <div class="spacer"></div>

        <div class="job-description">
            <p><strong>Description:</strong></p>
            <p>{!! nl2br(e($job->jp_des)) !!}</p>
        </div>

        <div class="spacer"></div>

        <div class="im-v">
            @if($job->jp_img)
                <div class="image-container">
                    @foreach (explode(',', $job->jp_img) as $imagePath)
                        @if (file_exists(public_path(trim($imagePath))))
                            <img src="{{ asset(trim($imagePath)) }}" alt="Job Image">
                        @endif
                    @endforeach
                </div>
            @endif

            @if($job->jp_video)
                <div class="video-container">
                    @foreach (explode(',', $job->jp_video) as $videoPath)
                        @if (file_exists(public_path(trim($videoPath))))
                            <video controls>
                                <source src="{{ asset(trim($videoPath)) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
@endsection
