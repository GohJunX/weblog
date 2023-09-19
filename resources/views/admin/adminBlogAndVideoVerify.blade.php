@extends('layouts.appAdmin')

@section('content')

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            background-color: #f5f5f5;
        }

        .button-box {
            margin-top: 20px;
            margin-left: 20px;
        }

        .button-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .button {
            margin-right: 10px;
            cursor: pointer;
            padding: 10px 20px;
            background-color: #428bca;
            color: #fff;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s;
        }

        .button:hover {
            background-color: #3071a9;
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Updated styling for the "Blogs" and "Short Videos" buttons */
        .button-blogs {
            background-color: #3498db; /* Red color for Blogs button */
        }

        .button-videos {
            background-color: #3498db; /* Blue color for Short Videos button */
        }

        /* Style for the active (selected) button */
        .button.active {
            background-color: #2ecc71; /* Green color for active button */
        }

        /* Hover effect for the buttons */
        .button-blogs:hover {
            background-color: #2980b9; /* Darker red on hover */
        }

        .button-videos:hover {
            background-color: #2980b9; /* Darker blue on hover */
        }

        .box {
            display: none;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .active {
            display: block;
        }

        .blog,
        .video {
            display: inline-block;
            margin: 10px;
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: center;
        }

        .blog-link,
        .video-link {
            text-decoration: none;
            color: #333;
        }

        .blog p,
        .video p {
            margin-top: 10px;
            font-weight: bold;
        }

        .blog:hover,
        .video:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .blog-image,
        .video-thumbnail {
            width: 120px;
            height: 90px;
            object-fit: cover;
            border-radius: 5px;
        }

        .spacer {
            height: 20px;
        }

        .button-group {
            text-align: center; /* Center align the content */
        }

        .button {
            display: inline-block;
            padding: 15px 25px; /* Adjust padding to make the buttons larger */
            margin: 0 10px; /* Add margin to separate the buttons */
            font-size: 18px; /* Adjust font size as needed */
    
        }
    </style>
</head>

<script>
    window.onload = function() {
        showBox('blogs');
    }

    function showBox(boxId) {
        var boxes = document.getElementsByClassName('box');
        for (var i = 0; i < boxes.length; i++) {
            boxes[i].style.display = 'none';
        }
        document.getElementById(boxId).style.display = 'block';

        // Remove the "active" class from all buttons
        var buttons = document.getElementsByClassName('button');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].classList.remove('active');
        }

        // Add the "active" class to the selected button
        document.querySelector('.button-' + boxId).classList.add('active');
    }
</script>

<body>
    <div class="button-box">
        <div class="button-group">
            <span class="button button-blogs" onclick="showBox('blogs')">Blogs</span>
            <span class="button button-videos" onclick="showBox('videos')">Short Videos</span>
        </div>
        <div class="spacer"></div>
        <div id="blogs" class="box">
            <h1><strong>Blogs</strong></h1>
            <div style="padding:30px"></div>
            @foreach($blogs as $blog)
            <div class="blog">
                <a href="{{ route('admin.verifyB.show', $blog->blog_id) }}" class="blog-link">
                @if($blog->blog_interface_img_file_path)
                    <img class="blog-image" src="{{ asset($blog->blog_interface_img_file_path) }}" alt="Blog Image">
                    @else
                    <img class="blog-image" src="{{ asset('images/boss-thumbs-up-employee.jpg') }}" >
                    @endif
                    <p>{{ $blog->blog_title }}</p>
                </a>
            </div>
            @endforeach
        </div>

        <div id="videos" class="box">
        <h1><strong>Short videos</strong></h1>
        <div style="padding:30px"></div>
            @foreach($shorts as $short)
            <div class="video">
                <a href="{{ route('admin.verifyS.show', $short->short_id) }}" class="video-link">
                    <img class="video-thumbnail" src="{{ asset($short->interface_path) }}" alt="Video Thumbnail">
                    <p>{{ $short->short_des }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</body>
@endsection