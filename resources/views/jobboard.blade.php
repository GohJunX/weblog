@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Job Board</title>
  
</head>
<meta charset="UTF-8">
<style>
html, body, h1, h3, p, input, button {
    margin: 0;
    padding: 0;
    line-height: 1.5;
    font-family: Arial, sans-serif;
}

body {
font-family: Arial, sans-serif;
line-height: 1.5;
background-color: #f5f5f5;
overflow-x: hidden;
}
/* Header */
/* header {
    background-color: #333;
    color: #fff;
    padding: 20px;
} */

/* Main content */
main {
    margin: 20px;
    
}

section {
    margin-bottom: 30px;
}


form input[type="text"] {
    padding: 5px;
    margin-right: 10px;
    width: 200px;
}

form button {
    padding: 5px 10px;
    background-color: #333;
    color: #fff;
    border: none;
    cursor: pointer;
}

.job-listings {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 20px;
    
}

.job {
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); 
}

.job h3 {
    font-size: 18px;
    margin-bottom: 5px;
}

.job p {
    margin-bottom: 5px;
}

.job a {
    display: inline-block;
    padding: 5px 10px;
    background-color: #333;
    color: #fff;
    text-decoration: none;
    margin-top: 10px;
}

/*paginate */

.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}

.pagination .page-link {
  padding: 6px 12px;
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 3px;
  color: #333;
  text-decoration: none;
}

.pagination .page-link:hover {
  background-color: #ddd;
}

.pagination .page-item.active .page-link {
  background-color: #333;
  color: #fff;
}

.pagination .page-item.disabled .page-link {
  background-color: #f9f9f9;
  color: #999;
  cursor: not-allowed;
}

.pagination .page-item:first-child .page-link,
.pagination .page-item:last-child .page-link {
  padding: 1px 1px; /* 调整首尾按钮的大小 */
}

.pagination .page-item:not(:first-child):not(:last-child) .page-link {
  padding: 6px 8px; /* 调整其他按钮的大小 */
}

/* Footer */
footer {
    background-color: #333;
    color: #fff;
    padding: 20px;
    text-align: center;
}

.slider-container {
            overflow: hidden;
            width: 100%; /* Adjust the width as needed */
            margin: 0 auto; /* Center the slider */
        }

        .slider {
            display: flex;
            transition: transform 0.3s ease;
        }

        .slide {
            flex: 0 0 100%;
            max-width: 100%;
            height: auto;
        }

        .slider img {
            width: 100%;
             /* Make sure images don't exceed the container's width */
            height: 570px; /* Maintain the aspect ratio */
        }
        /* Navigation buttons styles */
        .slider-nav {
         /* Add position absolute to place the buttons over the slider */
        display: flex;
        align-items: center;
        top: 65.4%; /* Position the buttons vertically in the middle */
        width: 100%;
        transform: translateY(-50%); /* Center the buttons vertically */
    }

    .slider-btn {
        padding: 275px 15px 272px 15px ;
        background-color: rgba(51, 51, 51, 0.3);
        color: #fff;
        border: none;
        cursor: pointer;
        flex: 0 0 auto; /* Prevent the buttons from growing or shrinking */
    }

    /* Position the buttons closer to the images */
    .slider-btn:first-child {
        position: absolute;
         /* Adjust the value to move the first button closer to the image */
         bottom: -1px;
         
    }

    .slider-btn:last-child {
        position: absolute;
        right: 0px;/* Adjust the value to move the second button closer to the image */
        bottom: -1px;
    }

    /* Styles for the icons */
    .fa-chevron-left,
    .fa-chevron-right {
        font-size: 20px;
    }

    /* Optional: Add some hover styles */
    .slider-btn:hover {
        background-color: #555;
    }

    .job-info {
    margin-left: 10px; /* Adjust the margin as needed */
}
    
</style>
<body>
    <main>
          
 
        <section>
    
            <h2><strong>Search Jobs</strong></h2>
            <form action="{{ route('job.search') }}" method="GET">
              <div class="input-group mb-3">
                    <input type="text" name="keywords" class="form-control" placeholder="Keywords" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); ">
                    <button type="submit" class="btn btn-dark" style=" box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">Search</button>
                </div>
            </form>
        </section>

      
        <section>
     
            <div class="slider-container" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); ">
                <div class="slider" >
                    <!-- Replace the URLs with your actual image URLs -->
                    <div class="slide"><a href="/blog"><img src="nav/shutterstock_451991974-1.png" alt="Image 1"></a></div>
                    <div class="slide"><a href="{{route('video.home')}}"><img src="nav\efeito-de-texto-curto-de-video-vermelho-3d_17005-1624.png" alt="Image 2"></a></div>
            
                    <div class="slide"><a href="/quizzes"><img src="nav/9bea646b8d9d5a6950e2806a8ad28a5d.png" alt="Image 3"></a></div>
        
                
                </div>
            </div>
            <!-- Navigation buttons -->
            <div class="slider-nav">
                <button class="slider-btn prev" onclick="prevSlide()"><i class="fas fa-chevron-left"></i></button>
                <button class="slider-btn next" onclick="nextSlide()"><i class="fas fa-chevron-right"></i></button>
            </div>
        </section>
     

        <section>
            <h2>Available Jobs</h2>
            <div class="job-listings">
                @foreach($jobs as $job)
                    <div class="job">
                    <h3><strong>Job Title:</strong> {{ $job->jp_pos }}</h3>
                    <p class="job-info"><i class="fas fa-building"></i> <strong>Company Name:</strong> {{ $job->user->name }}</p>
                    <p class="job-info"><i class="fas fa-map-marker-alt"></i> <strong>Job Location:</strong> {{ $job->jp_location }}</p>
                    <p class="job-info"><i class="fas fa-clock"></i> <strong>Full or Part:</strong> {{ $job->jp_fulltime_parttime }}</p>
                    <a href="{{ route('job.show', $job->jp_id) }}"> Detail</a>
                                        
                    </div>
                    
                @endforeach
            </div>
            <input type="hidden" id="scrollPosition" value="0">
        <!-- <div class="pagination justify-content-center">
        {{ $jobs->links() }} 
        </div> -->
        </section>

        
    </main>
    <script>
        // JavaScript for the slider
        const slider = document.querySelector('.slider');
        const slides = document.querySelectorAll('.slide');
        let slideIndex = 0;
        const slideWidth = slides[0].clientWidth;

        function nextSlide() {
            slideIndex = (slideIndex + 1) % slides.length;
            slider.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
        }

        function prevSlide() {
            slideIndex = (slideIndex - 1 + slides.length) % slides.length;
            slider.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
        }

        // Change slide every 5 seconds (adjust the duration as needed)
        setInterval(nextSlide, 5000);

        // Add event listeners to handle slider navigation
        // Replace the ".next" and ".prev" selectors with your actual navigation buttons
        document.querySelector('.next').addEventListener('click', nextSlide);
        document.querySelector('.prev').addEventListener('click', prevSlide);
</script>
<script>
        // Function to handle pagination link clicks
        function handlePaginationClick(event) {
            // Prevent default link behavior
            event.preventDefault();

            // Get the target URL
            const targetUrl = event.target.getAttribute('href');

            // Use Ajax to fetch the content of the target page
            fetch(targetUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(data => {
                // Replace the current page content with the fetched content
                document.documentElement.innerHTML = data;

                // Re-apply the slider settings (continues sliding)
                slideIndex = 0;
                setInterval(nextSlide, 5000);
            });
        }

        // Listen for click events on pagination links
        document.addEventListener('click', function(event) {
            if (event.target.matches('.pagination a')) {
                handlePaginationClick(event);
            }
        });
    </script>
    <footer>
        <p>&copy; {{ date('Y') }} Weblog for job seeker and employer</p>
    </footer>
  
</body>


</html>
@endsection