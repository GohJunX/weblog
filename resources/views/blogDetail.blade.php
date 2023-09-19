@extends('layouts.app')

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
        .card {
            margin-top: 20px;
            border: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.5rem;
            color: #333;
        }

        .card-subtitle {
            color: #888;
        }

        .blog-video img,
        .blog-image img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-back {
            float: right;
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-back:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Blog Detail</h1>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title">{{ $blog->blog_title }}</h2>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Content</h3>
                <div>{!! $blog->blog_content !!}</div>
            </div>
        </div>

        @if ($blog->blog_video_file_path)
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Blog Videos</h3>
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
        </div>
        @endif

        @if ($blog->blog_img_file_path)
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Blog Images</h3>
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
        </div>
        @endif
        
        <div style="padding:30px">
            <a href="javascript:history.back()" class="btn btn-back">Back</a>
        </div>
    </div>
</body>
</html>
@endsection
