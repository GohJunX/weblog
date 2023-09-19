@extends('layouts.appAdmin')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        /* Body styles */
        body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Header styles */
        h1 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #333;
        }

        /* Blog detail styles */
        p {
            line-height: 1.6;
            margin-bottom: 10px;
            color: #333;
        }

        /* Video and image styles */
        .blog-video img,
        .blog-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Button styles */
        .button-group {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            color: white;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            color: white;
        }

        /* Separate boxes */
        .box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .box-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{$blog->blog_title}}</h1>
        
        <div class="box">
            <h3 class="box-title">Content</h3>
            <p>{!! $blog->blog_content !!}</p>
        </div>

        
        @if ($blog->blog_video_file_path)
        <div class="box">
            <h3 class="box-title">Blog Videos</h3>
            <div class="row blog-video">
                @foreach (explode(',', $blog->blog_video_file_path) as $video)
                    @if (file_exists(public_path(trim($video))))
                        <div class="col-lg-4 col-md-6 mb-4">
                            <video src="{{ asset(trim($video)) }}" controls class="img-fluid"></video>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif
        
        @if ($blog->blog_img_file_path)
        <div class="box">
            <h3 class="box-title">Blog Images</h3>
            <div class="row blog-image">
                @foreach (explode(',', $blog->blog_img_file_path) as $image)
                    @if (file_exists(public_path(trim($image))))
                        <div class="col-lg-4 col-md-6 mb-4">
                            <img src="{{ asset(trim($image)) }}" alt="Blog Image" class="img-fluid">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        <div class="button-group">
            <form action="{{route('admin.verifyB.approve',$blog->blog_id)}}" method="POST">
                @csrf
                <button class="btn btn-success">Approve</button>
            </form>
            <form action="{{route('admin.verifyB.reject',$blog->blog_id)}}" method="POST">
                @csrf
                <button class="btn btn-danger">Reject</button>
            </form>
        </div>
    </div>
</body>
</html>

@endsection
