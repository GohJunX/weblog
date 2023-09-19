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
        /* Add your existing profile styles here */
        width: 80%;
        margin: 0 auto;
        display: flex;
        justify-content: space-between; /* Aligns items to both ends */
        
    }
    #pic{
        align-items: center; /* Center align items vertically */
    }

 

    .profile-picture {
        /* Add your existing profile picture styles here */
        width: 150px; 
        height: 150px; 
        border: 2px solid #ccc;
        border-radius: 10%; 
    }

    .user-details {
        /* Add your existing user details styles here */
        font-size: 18px;
        margin-left: 20px;
    }

    .completed-quizzes {
        /* Add styles to remove the bullet point from the ul */
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .completed-quizzes li {
        /* Add styles for each completed quiz item */
        margin-bottom: 10px;
    }

    .completed-quizzes li::before {
        /* Add styles for a custom bullet point, e.g., a checkmark */
        
        margin-right: 10px;
      
        font-weight: bold;
    }

    /* Add a separate container for the completed quizzes */
    .completed-quizzes-container {
        display: flex;
        flex-direction: column;
        align-items: flex-end; /* Aligns items to the right */
    }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        p {
            margin: 5px 0;
        }

         #Rdownload{
            color: blue;
            text-decoration: none;
            border-radius: 3px;
        }

        .button-group {
            margin-bottom: 20px;
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

        .blog-image {
            width: 200px;
            height: 225px;
        }
        
        .video-thumbnail {
            width: 200px;
            height: 225px;
        }

        .spacer {
        height: 20px; /* 设置空白元素的高度 */
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

        .profile-details {
            /* Add styles for the profile details box */
            width: 55%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 3px;
            overflow: auto;
        }

        .completed-quizzes-box {
            /* Add styles for the completed quizzes box */
            width: 45%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 3px;
            overflow: auto;
        }

        .btn-show-box {
    margin-right: 10px;
    cursor: pointer;
    padding: 8px 20px;
    border: none;
    border-radius: 5px;
    background-color: #428bca;
    color: #fff;
    transition: background-color 0.3s ease;
}

.btn-show-box:hover {
    background-color: #3071a9;
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

.btn-blogs {
    background-color: #3498db; /* Blue color for Blogs button */
    color: white; /* Text color */
}

/* Style for the "Show Short Videos" button */
.btn-videos {
    background-color: #3498db; /* Blue color for Short Videos button */
    color: white; /* Text color */
}

/* Hover effect for the buttons */
.btn-blogs:hover {
    background-color: #2980b9; /* Darker blue on hover */
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
    margin-left: 10px; /* Adjust the margin as needed */
}

.quiz-info {
    margin-left: 10px; /* Adjust the margin as needed */
}
</style>
  
   
</head>
<body>
<div class="d-flex">
    <div class="profile">
   
    <div class="align-items-center" >
    @if($user->u_profile_pic)
        <img class="profile-picture" src="{{asset($user->u_profile_pic)}}" style="margin:35px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
    @else
        <img class="profile-picture" src="{{asset('images/ProfilePicture.png')}}"  style="margin:35px;">
    @endif
    </div>
        <div class="profile-details active" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
            <h1>Name: {{$user->name}}</h1>
            <br>
            <p class="user-info"><i class="fas fa-envelope"></i> <strong>Email:</strong> {{$user->email}}</p>
            <p class="user-info"><i class="fas fa-map-marker-alt"></i> <strong>State:</strong> {{$user->u_state}}</p>
            <p class="user-info"><i class="fas fa-venus-mars"></i> <strong>Gender:</strong> {{$user->u_gender}}</p>

            @if($user->u_resume_file_path)
                <p class="user-info"><i class="fas fa-file-pdf"></i> <strong>Resume:</strong></p>
                <a class="user-info" id="Rdownload" href="{{ asset($user->u_resume_file_path) }}" download>Download Resume</a>
            @else
                <p class="user-info"><i class="fas fa-file-pdf"></i> <strong>Resume: No Resume Upload</strong></p>
            @endif

        </div>
    </div>
        <div class="completed-quizzes-box" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                @if(count($quizzes) > 0)
                    <h2>Completed Quizzes</h2>
                    <ul class="completed-quizzes">
                    <br>
                    @foreach($quizzes as $quiz)
                        <li class="quiz-info">
                            <i class="fas fa-poll"></i> <strong>Quiz Title:</strong> {{ $quiz->title }}
                            <br>
                            <i class="fas fa-percent"></i> <strong>Total Score:</strong> {{ $quiz->pivot->score }}%
                        </li>
                    @endforeach
                    </ul>
                @endif
            </div>
        </div>

    <div>
    <div class="d-flex">
    <button class="btn btn-primary btn-blogs" onclick="showBox('blogs')" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">Show Blogs</button>
    <button class="btn btn-primary btn-videos" onclick="showBox('videos')" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">Show Short Videos</button>
    </div>
        <div class="spacer"></div>
        <div id="blogs" class="box active">
    <h2 class="mb-3">Blogs</h2>
    <div class="row">
            @foreach($blogs as $blog)
            <div class="col-md-4 mb-3">
                <div class="blog-card">
                    <a href="{{ route('blog.profile', $blog->blog_id) }}" style="text-decoration:none;">
                    @if($blog->blog_interface_img_file_path)
                        <img class="blog-image img-fluid rounded" src="{{ asset($blog->blog_interface_img_file_path) }}" >
                    @else
                    <img class="blog-image img-fluid rounded" src="{{ asset('images/boss-thumbs-up-employee.jpg') }}" >
                    @endif
                    
                    <div class="blog-details mt-2">
                        <h5 style="color:black;"class="blog-title">{{ $blog->blog_title }}</h5>
                   
                    </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
        <div id="videos" class="box">
            <h2 class="mb-3">Short Videos</h2>
            <div class="row">
                @foreach($videos as $video)
                <div class="col-md-3 mb-3">
                    <div class="video-card">
                        <a href="{{ route('videoD.home', $video->short_id) }}">
                            <img class="video-thumbnail img-fluid rounded" src="{{ asset($video->interface_path) }}" alt="Video Thumbnail">
                        </a>
                        <div class="video-details mt-2">
                            <h5 class="video-title">{{ $video->title }}</h5>
                            <p class="video-description">{{ $video->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
 
</div>
            

    </div>
    
    <script>
        function showBox(boxId) {
    // Remove 'active' class from all buttons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    // Add 'active' class to the selected button
    const selectedButton = document.querySelector('.btn-' + boxId);
    selectedButton.classList.add('active');

    // Store the selected button's state in localStorage
    localStorage.setItem('selectedButton', boxId);

    // Remove 'active' class from all box elements
    const boxes = document.querySelectorAll('.box');
    boxes.forEach(box => {
        box.classList.remove('active');
    });

    // Add 'active' class to the selected box
    const selectedBox = document.getElementById(boxId);
    selectedBox.classList.add('active');
}

window.addEventListener('load', function () {
    // Retrieve the selected button's state from localStorage
    const selectedButton = localStorage.getItem('selectedButton');

    if (selectedButton) {
        // Set the selected button's state when the page loads
        showBox(selectedButton);
    }
});

        // Get the initial active box from the URL hash
        var activeBox = window.location.hash.substr(1);

        // If the active box is set, show it on page load
        if (activeBox) {
            showBox(activeBox);
        }

    </script>
</body>
</html>
@endsection