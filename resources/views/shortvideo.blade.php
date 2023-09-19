@extends('layouts.app')

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
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 78vh; /* Optionally, set the height to 100% of the viewport height */
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
  padding-top: 121px;
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
    left: 500px;
    z-index: 999;
    font-size: 5em;
    color: #f0f0f0;
    cursor: pointer;
    
}

.prev_next .prev:hover{
    background-color: grey;
}

.prev_next .next{
    position: absolute;
    top: 40%;
    right: 500px;
    z-index: 999;
    font-size: 5em;
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
}

.video-player.active {
    display: block;
    z-index: 0;
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

.upload-button-container {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 20px;
    color: #fff;
    position: fixed;
    bottom: 10px;
    right: 10px;
    cursor: pointer;
  }

  .upload-button-container i {
    font-size: 30px;
  }
  #shareDialog {
        display: none;
        bottom: 50px;
        right: 50px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    #shareDialog.show {
        display: block;
    }

    #shareDialog button {
        display: block;
        width: 100%;
        padding: 8px;
        border: none;
        background-color: #f0f0f0;
        margin-bottom: 5px;
        cursor: pointer;
    }

   #shortD {
    float: left;
    margin-left:10px;

 
}

        /* Style for comment name */
        #comment-name {
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

        .upload-button {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    padding: 10px 20px;
    border: 2px solid grey;
    border-radius: 5px;
    background-color: white;
    color: grey;
    transition: background-color 0.3s, color 0.3s, transform 0.3s;
}

.upload-button:hover {
    background-color: lightblue;
    color: white;
    transform: scale(1.05);
}

.upload-button .fa-upload {
    margin-right: 10px;
}

.upload-label {
    font-size: 18px;
    font-weight: bold;
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

.comment-item{

  width:100%;
  text-align: left;
}
</style>
</head>


<body>
<div class="container">
    <main class="content">
        <section id="home" class="box home active">
            @foreach ($videos as $key => $video)
        
                          <div id='videodiv'>
                              <video id="video_{{ $video->short_id }}" class="video-player{{ $key === 0 ? ' active' : '' }}" controls >
                                  <source src="{{ asset($video->short_file_path) }}" type="video/mp4">
                                  <p>{{$video->short_id}}</p>
                              </video>
                          </div>   

                          <div class="right-bar">
                          <ul>
                          @if(Auth::check())
                              @if (auth()->user()->u_role == "job_seeker")
                                  <a href="/profile/show/{{ $video->user->id }}">
                                      <li>
                                          <img src="{{ asset($video->user->u_profile_pic) }}" alt="">
                                      </li>
                                  </a>
                              @elseif (auth()->user()->u_role == "employer")
                                  <a href="/profile/show/{{ $video->user->id }}">
                                      <li>
                                          <img src="{{ asset($video->user->u_profile_pic) }}" alt="">
                                      </li>
                                  </a>
                              @endif
                          @endif
                          <li>
                          @if(Auth::check())
                              <!-- User is logged in, show the like button -->
                              <button id="likeButton_{{ $video->short_id }}" class="like-button" onclick="toggleLike({{ $video->short_id }})">
                                  <i class="fa-solid fa-heart"></i> 
                              </button>
                              @csrf
                              @method('POST')
                              <span id="likeCount_{{ $video->short_id }}">{{ $thumbsupCount->where('short_id', $video->short_id)->count() }}</span>
                          @else
                              <!-- User is not logged in, show login prompt or message -->
                             <a href="/login"><i class="fa-solid fa-heart"></i></a>
                             @csrf
                              @method('POST')
                              <span id="likeCount_{{ $video->short_id }}">{{ $thumbsupCount->where('short_id', $video->short_id)->count() }}</span>
                          @endif
                            </li>
                              <li>
                                  <button id="commentIcon" onclick="showMe()">
                                      <i class="fa-solid fa-comment-dots"></i>
                                  </button>
                                  @csrf
                                  @method('POST')
                                  <span>{{ $comment->where('video_id', $video->short_id)->count() }}</span>
                              </li>
                              <li>
                              <i class="fa-solid fa-share" id="shareIcon"></i>
                                <div id="shareDialog">
                                    <button id="copyLinkBtn">Copy Link</button>
                                    <!-- Add other share options here -->
                                </div>
                                 
                              </li>
                            
                          </ul>
                         
                          </div>

                          <div id="commentModal" class="modal" style="display:none">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3>Comments</h3>
                                    <span class="close">&times;</span>
                            </div>

                      <div class="modal-body" style=" max-height: 400px; overflow-y: auto;">
                          <!-- Existing Comments -->
                          <ul class="list-group">
                          @foreach($comment as $comments)
                          @if($video->short_id==$comments->video_id )
                          <li class="list-group-item d-flex comment-item">
                          <div id="existingComments">
                            <p id="comment-name" >{{$comments->user->name}}</p>
                              <p class="comment-text">{{$comments->comment_text}}</p>
                        
                          </div>
                          </li>
                          @endif
                
                          @endforeach
                          </ul>
                          <!-- New Comment Form -->
                          <form method="POST" action="{{route('comments.store', $video->short_id)}}">
                                                  
                          @csrf
                          @method('POST')
                              <textarea name="comment_text" id="commentInput" rows="3" placeholder="Write your comment"></textarea>
                            
                              @if(Auth::check())
                              <button type="submit">Submit</button>
                              @endif
                          </form>
                      </div>
                  </div>
              </div>
     
            @endforeach
        </section>
      
    </main>

</div>

 
<div id="shortDes">
    <div class="scrollable-content">
        <p id="shortD">{{$video->short_des}}</p>
    </div>
</div>
  
             
  <div class="pagination justify-content-center">
    <div class="prev_next">
        <div class="prev" onclick="showPrevPage()">
            <i class="bx bxs-chevron-left"></i>
        </div>
    </div>

    <div style="display:none;">{{ $videos->links() }} </div>

    <div class="prev_next">
        <div class="next" onclick="showNextPage()">
            <i class="bx bxs-chevron-right"></i>
        </div>
    </div>
</div>

   
   <div class="upload-button-container" >
    <a href="{{ 'shortVideo/upload'}}" class="upload-button">
        <i class="fa fa-upload" style="font-size: 30px; color: grey;"></i>
        <span class="upload-label">Upload Video</span>
    </a>
</div>




   

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add the JavaScript code below this HTML code -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  var videoId = "{{ $video->short_id }}";
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

var firstVideo = document.querySelector(".video-player.active");
  if (firstVideo) {
    firstVideo.play();
  }
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

<script>
    document.getElementById("shareIcon").addEventListener("click", function() {
        var shareDialog = document.getElementById("shareDialog");
        shareDialog.classList.toggle("show");
    });

    document.getElementById("copyLinkBtn").addEventListener("click", function() {
        var videoUrl = window.location.href; // Replace this with the actual video URL
        copyToClipboard(videoUrl);
        alert("Link copied to clipboard!");                                                                                                                                                                                                 
    });

    function copyToClipboard(text) {
        var textArea = document.createElement("textarea");
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("copy");
        document.body.removeChild(textArea);
    }

</script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               

   

<script>
   function showPrevPage() {
    const prevLink = document.querySelector('a[rel="prev"]');
    if (prevLink) {
        window.location.href = prevLink.getAttribute("href");
    }
}

// Function to navigate to the next page
function showNextPage() {
    const nextLink = document.querySelector('a[rel="next"]');
    if (nextLink) {
        window.location.href = nextLink.getAttribute("href");
    }
}
</script>
    <script src="https://kit.fontawesome.com/9e5ba2e3f5.js" crossorigin="anonymous"></script>
    

</body>


@endsection