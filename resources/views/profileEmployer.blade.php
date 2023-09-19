@extends('layouts.app')


@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
   
    <style>
        body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }

        .profile {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 100px;
        }

       .user-details {
            margin-left: 20px;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        p {
            margin: 5px 0;
        }

         #Rdownload{
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            color: blue;
            text-decoration: none;
            border-radius: 3px;
        }

        .button-group {
            margin-bottom: 20px;
        }

        
        .button-group .btn {
          
        }
        .button {
            margin-right: 10px;
            cursor: pointer;
            padding: 8px 12px;
            background-color: #428bca;
            color: #fff;
            border: none;
            border-radius: 3px;
        }

        .button:hover {
            background-color: #3071a9;
        }

        .box {
            display: none;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .active {
            display: block;
        }

        
        .video-thumbnail {
            width: 200px;
            height: 225px;
        }

        .spacer {
        height: 20px; 
        }
        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            color: #333;
            cursor: pointer;
            z-index: 2;
        }

        .left-arrow {
            left: 0;
        }

        .right-arrow {
            right: 0;
        }

        .blog-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 6px;
    background-color: #fff;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: 320px; /* Set a fixed height for the blog card */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.blog-card:hover {
    transform: translateY(-2px);
}

.blog-image {
    width: 100%;
    height: auto;
    max-height: 180px; /* Set a max height for the blog image */
    object-fit: cover;
}

.blog-details {
    padding: 5px;
    text-align: center;
}

.blog-title {
    margin-top: 6px;
    font-size: 16px;
    font-weight: bold;
}

.blog-summary {
    margin-top: 3px;
    font-size: 12px;
    color: #777;
}

.video-card {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 6px;
    background-color: #fff;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    height: 320px; /* Set a fixed height for the video card */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.video-card:hover {
    transform: translateY(-2px);
}

.video-thumbnail {
    width: 100%;
    height: auto;
    max-height: 180px; /* Set a max height for the video thumbnail */
    object-fit: cover;
}

.video-details {
    padding: 5px;
    text-align: center;
}

.video-title {
    margin-top: 6px;
    font-size: 16px;
    font-weight: bold;
}

.video-description {
    margin-top: 3px;
    font-size: 12px;
    color: #777;
}
.profile {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 10%;
    border: 2px solid #ccc;
    display: flex;
    overflow: hidden;
}

.profile-picture img {
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
}

.user-details {
    margin-left: 20px;
}

.button-group {
    margin-bottom: 20px;
    display: flex;
    
}

.button-group .btn {
    cursor: pointer;
}

.user-details-box {
    background-color: #fff;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    max-width:100%;
    padding-right:600px;
}

.user-details-box h1 {
    margin: 0;
    font-size: 24px;
    margin-bottom: 10px;
}

.user-details-box p {
    margin: 5px ;
}

.company-description-box {
    background-color: #ccc;
    padding: 20px;
    border: 1px solid #ccd;
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    margin-right: -557px;
}

.btn-blogs {
            background-color: #3498db; /* Red color for Blogs button */
            color: white; /* Text color */
        }

        /* Style for the "Short Videos" button */
        .btn-videos {
            background-color: #3498db; /* Blue color for Short Videos button */
            color: white; /* Text color */
        }

        /* Hover effect for the buttons */
        .btn-blogs:hover {
            background-color: #2980b9; /* Darker red on hover */
        }

        .btn-videos:hover {
            background-color: #2980b9; /* Darker blue on hover */
        }

        /* Updated styling for the active button */
        .btn.active {
            background-color: #2ecc71; /* Green color for active button */
            color: white; /* Text color */
        }

        .user-info {
            padding-left: 10px; 
        }
    </style>
   
</head>
<body>
    <div class="profile">
   
        <div class="user-details-box" style="position:relative; left:75px; top:20px; max-width:1280px; max-width:1280px box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
            @if($user->u_profile_pic)
                <img class="profile-picture" src="{{asset($user->u_profile_pic)}}" style="position: absolute; top: 0; right: 0;  margin: 10px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5);">
                @else
                    <img class="profile-picture" src="{{asset('images/ProfilePicture.png')}}" style="position: absolute; top: 0; right: 0; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5);">
                @endif
        
            <h2>Name: {{$user->name}}</h2>
            <p class="user-info" style="padding-top:10px;"><i class="fas fa-envelope"></i> <strong>Email:</strong> {{$user->email}}</p>
            <p class="user-info"><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{$user->u_location}}</p>
            <p class="user-info"><i class="fas fa-phone"></i> <strong>Phone-no:</strong> {{$user->u_phone_number}}</p>

        
            <div class="company-description-box" style="margin-top: 60px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.5);">
                    <p><strong>Company Description:</strong></p>
                    
                    <p>{!! nl2br(e($user->u_desc)) !!}</p>
            </div>
        </div>
    </div>
    
    <div>
    <div class="button-group">
        <!-- Apply the button styles -->
        <span class="btn btn-blogs" id="btn-blogs" onclick="showBox('blogs')">Show Blogs</span>
        <span class="btn btn-videos" id="btn-videos" onclick="showBox('videos')">Show Short Videos</span>
    </div>
        <div id="blogs" class="box active">
    <h2 class="mb-3">Blogs</h2>
    <div class="row">
        @foreach($blogs as $blog)
        <div class="col-md-4 mb-3">
            <div class="blog-card">
                <a href="{{ route('blog.profile', $blog->blog_id) }}">
                @if($blog->blog_interface_img_file_path)
                <img class="blog-image img-fluid rounded" src="{{ asset($blog->blog_interface_img_file_path) }}" alt="Blog Image">
                @else
                <img class="blog-image img-fluid rounded" src="{{ asset('images/boss-thumbs-up-employee.jpg') }}" >
                @endif
                </a>
                <div class="blog-details mt-2">
                    <h5 class="blog-title">{{ $blog->blog_title }}</h5>
                    <p class="blog-summary">{{ $blog->blog_summary }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
        

<div id="videos" class="box">
    <h2 class="mb-3">Short Videos</h2>
    <div class="row">
        @foreach($videos as $video)
        <div class="col-md-4 mb-3">
            <div class="video-card">
                <a href="{{ route('videoD.home', $video->short_id) }}">
                    <img class="video-thumbnail img-fluid rounded" src="{{ asset($video->interface_path) }}" alt="Video Thumbnail">
                </a>
                <div class="video-details mt-2">
                    <h5 class="video-title">{{ $video->video_title }}</h5>
                    <p class="video-description">{{ $video->video_description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
        
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <script>
        function showBox(boxId) {
            // Remove 'active' class from all buttons
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Add 'active' class to the selected button
            const selectedButton = document.getElementById('btn-' + boxId);
            selectedButton.classList.add('active');

            const boxes = document.querySelectorAll('.box');
            boxes.forEach(box => {
                box.classList.remove('active');
            });

            // Add 'active' class to the selected box
            const selectedBox = document.getElementById(boxId);
            selectedBox.classList.add('active');

            // Store the active button in local storage
            localStorage.setItem('activeButton', boxId);
        }

        // Get the active button from local storage and show the corresponding box
        const activeButton = localStorage.getItem('activeButton');
        if (activeButton) {
            showBox(activeButton);
        }

    </script>
</body>
</html>
@endsection