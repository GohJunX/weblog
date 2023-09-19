@extends('layouts.appAdmin')

@section('content')
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short video</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --whiteColor: #ffffff;
    --redColor: #fe2c55;
    --blackColor: #161823;
    --grayColor: #cccccc;
    --lightBlue: #36d1dc;
    --limeGreen: limegreen;
}

html {
  font-size: 62.5%;
}

ul {
    list-style: none;
}

a {
    text-decoration: none;
}

body {
    
    place-content: center;
    min-height: 100vh;
    font-family: 'Montserrat', sans-serif;
    font-weight: 400;
    background-color: #555;
}

.container {
    margin-top:20px;
    position: relative;
    width: 34rem;
    height: 57rem;
    background-color: #556;
    box-shadow: 0 0.5rem 0.5rem rgba(0 0 0 / .15);
    overflow: hidden;
   
}


.content {
    position: relative;
    display: flex;
    text-align: center;
}

.content .box {
    position: relative;
    width: 0rem;
    height: 100%;
    visibility: hidden;
    opacity: 0;
    transition: all .3s ease-in-out;
}

.content .box.active {
    width: 35rem;
    visibility: visible;
    opacity: 1;
    left: 0;
}

/*Start Home Section*/

#videodiv {
  position: relative;
  justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 73vh; /
}

.video-player {
  width: 100%;
}

.right-bar {
  position: absolute;
  top: 10px;
  right: 10px;
  padding: 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 5px;
  padding-top:121px;

}

.right-bar ul {
  list-style: none;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
 
}

.right-bar ul li {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  z-index: 1;
}

.right-bar ul li:last-child {
  margin-bottom: 0;
}

.right-bar ul li img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); /* Add a box shadow to the icons */
}

.right-bar ul li i {
  margin-right: 5px;
  font-size: 24px; /* Increase the icon size */
  color: white; /* Change the icon color */
   /* Add a box shadow to the icons */
}

.right-bar ul li span {
  margin-left: 5px;
  font-size: 14px; /* Increase the text size */
  color: white; /* Change the text color */
  font-weight: bold; /* Add font weight to the text */
  text-align: center;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.5)); 
}

#commentIcon {
  text-decoration: none;
  color: #000;
}

.fa-heart,
.fa-comment-dots,
.fa-share,
.fa-upload {
  font-size: 24px;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.5));
}

/*End Home Section*/

.prev_next{
    color: #fff;
    display: flex;
    align-items: center;
}

.prev_next .prev{
    position: absolute;
    top: 40%;
    left: 40px;
    z-index: 999;
    font-size: 2em;
    color: #f0f0f0;
    cursor: pointer;
    
}

.prev_next .prev:hover{
    background-color: grey;
}

.prev_next .next{
    position: absolute;
    top: 40%;
    right: 58px;
    z-index: 999;
    font-size: 2em;
    color: #f0f0f0;
    cursor: pointer;
}

.prev_next .next:hover{
    background-color: grey;
}

.modal{
    position:absolute; 
    top:200px;
    left:105px; 
    width:20%;

}
.video-player {
    width: 100%;
    height: 100%;
    display: none;
    display: block;
}



#commentModal {
  /* Initially hide the modal */
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin-left:1005px;
  z-index: 9999; /* Ensure the modal is on top of other elements */
}

#commentModal .modal-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  border-radius: 4px;
}

#commentModal .modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

#commentModal .modal-body {
  margin-top: 10px;
}

#commentModal .close {
  font-size: 24px;
  color: #888;
  cursor: pointer;
}

#commentModal h3 {
  margin: 0;
  font-size: 18px;
}

#commentModal textarea {
  width: 100%;
  height: 100px;
  padding: 10px;
  border-radius: 4px;
  border: 1px solid #ccc;
  resize: vertical;
  margin-bottom: 10px;
}

#commentModal button {
  padding: 8px 16px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#commentIcon{
    border:none;
    background-color:transparent;
}

.like-button {
  display: inline-block;
  background-color: transparent;
  border: none;
  cursor: pointer;
  outline: none;
}

.like-button i {
  color: #ccc;
  transition: color 0.3s ease-in-out;
}

.like-button.active i {
  color: red;
}

.button-group {
    /* Optional: You can add additional styling here for the container */
}

.inline-form {
    display: inline;
    /* Optional: Add margin or padding to create some space between the buttons */
    margin-right: 10px; /* Adjust this value as needed */
}

#shortDes #shortD {
    float: left;
    color: white;
    font-size: 10px;
    max-width: 335px;
    /* Prevent text overflow and add ellipsis for vertical overflow */
    overflow: hidden;
    text-overflow: ellipsis;
}

.comment-name {
            text-align: left;
            font-weight: bold;
            color: #007bff; /* You can change the color to your preference */
        }

        /* Style for comment text */
        .comment-text {
            font-size: 12px;
            text-align: left;
            color: #333; /* You can change the color to your preference */
        }

        .btn-xl {
            padding: 10px 15px; /* You can adjust these values for your preferred size */
            font-size: 14px; /* You can adjust the font size as well */
        }

        #shortDes {
        border-radius:5px; 
          display: flex;
          height: 50px; /* Set the desired height for the scrollable area */
          overflow: auto;
          background-color: #333; /* Set the background color as needed */
          color: white;
          max-width: 23%;
          margin-left:557px;
          font-size: 15px;
      }

      .scrollable-content {
          max-width: 80%; /* Adjust the maximum width as needed */
          text-align: center;
      }
</style>
</head>



<body>
<div class="container">
    <main class="content">
        <section id="home" class="box home active">
         
                <div id='videodiv'>
                    <video id="video_{{ $videos->short_id }}" class="video-player" controls>
                        <source src="{{ asset($videos->short_file_path) }}" type="video/mp4">
                        <p>{{$videos->short_id}}</p>
                    </video>
                </div>   

                <div class="right-bar">
                <ul>
                @if(Auth::check())
                    <li>
                        <img src='{{asset($videos->user->u_profile_pic)}}' alt="">
                    </li>
                @endif
                <li>
                <button id="likeButton_{{ $videos->short_id }}" class=like-button onclick="toggleLike({{ $videos->short_id }})">
                  <i class="fa-solid fa-heart"></i> 
                </button>
                    @csrf
                    @method('POST')
                    <span id="likeCount_{{ $videos->short_id }}">{{ $thumbsupCount->where('short_id', $videos->short_id)->count() }}</span>
                  </li>
                    <li>
                        <button id="commentIcon" onclick="showMe()">
                            <i class="fa-solid fa-comment-dots"></i>
                        </button>
                        @csrf
                        @method('POST')
                        <span>{{ $comment->where('video_id', $videos->short_id)->count() }}</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-share"></i>
                    </li>
                  
                </ul>
                </div>

             
                
                <div id="commentModal" class="modal" style="display:none">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Comments</h3>
                <span class="close">&times;</span>
            </div>

            <div class="modal-body">
                <!-- Existing Comments -->
                <ul class="list-group">
                @foreach($comment as $comments)
                @if($videos->short_id==$comments->video_id)
                <li class="list-group-item d-flex">
                <div id="existingComments">
              
                    <p class="comment-name">{{$comments->user->name}}</p>
                    <p class="comment-text">{{$comments->comment_text}}</p>
               
                </div>
                </li>
                @endif
                @endforeach
                </ul>
                <!-- New Comment Form -->
                <form method="POST" action="{{route('comments.store', $videos->short_id)}}">
                                        
                @csrf
                @method('POST')
                    <textarea name="comment_text" id="commentInput" rows="3" placeholder="Write your comment"></textarea>
                   
                   
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
       
        </section>
       
  
    </main>
</div>

<div id="shortDes">
    <div class="scrollable-content">
        <p id="shortD">{{$videos->short_des}}</p>
    </div>
</div>

<div class="button-group text-center">
    <form action="{{ route('admin.verifyS.approve', $videos->short_id) }}" method="POST" class="inline-form">
        @csrf
        <button class="btn btn-success btn-xl">Approve</button>
    </form>
    <form action="{{ route('admin.verifyS.reject', $videos->short_id) }}" method="POST" class="inline-form">
        @csrf
        <button class="btn btn-danger btn-xl">Reject</button>
    </form>
</div>





   

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add the JavaScript code below this HTML code -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  var videoId = "{{ $videos->short_id }}";
  var likeButton = document.getElementById("likeButton_" + videoId);

  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Make an AJAX request to check the like status
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "/likes/check/" + videoId, true);
  xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (response.liked) {
        likeButton.classList.add("active");
      }
    }
  };
  xhr.send();

  // Handle the like button click event
  likeButton.addEventListener("click", function() {
    toggleLike(videoId);
  });

  function toggleLike(videoId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/likes/" + videoId, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.liked) {
          likeButton.classList.add("active");
          location.reload();
        } else {
          likeButton.classList.remove("active");
          location.reload();
        }
      }
    };
    xhr.send();
  }
});

var elem = document.getElementById("commentModal");
    document.querySelector(".close").addEventListener("click", function() {
      elem.style.display = 'none';
    });




    function showMe() {
    var elem = document.getElementById("commentModal");
    var foo = window.getComputedStyle(elem, null);
    if (foo.getPropertyValue("display") == 'none') {
        elem.style.display = 'block';
    } else {
        elem.style.display = 'none';
    }
    }
    // Show the comment modal with the corresponding video ID
    function showModal() {
        var elem = document.getElementById("commentModal");
        var foo = window.getComputedStyle(elem, null);
       
        if (foo.getPropertyValue("display") == 'none'){
        document.getElementById("commentModal").style.display = "block";
        document.getElementById("videoShortId").value = videoId;
        loadExistingComments(videoId);}
        else {
        document.getElementById("videoShortId").value = videoId;
        elem.style.display = 'none';
    } // Load existing comments via AJAX for the specific video
    }
    
 
</script>

   


    <script src="https://kit.fontawesome.com/9e5ba2e3f5.js" crossorigin="anonymous"></script>
    

</body>


@endsection