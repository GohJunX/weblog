@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Weblog for Job Seeker and Employer</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        
        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 10px;
            color: #007bff; /* Change heading color */
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #333; /* Change text color */
        }

        a {
            color: #007bff;
            text-decoration: none;
        }



        /* Style the background image */
        body::after {
            content: "";
            background-image: url('your-image-url.png'); /* Replace with your image URL */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            opacity: 0.3;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: fixed;
            z-index: -1;
        }
    </style>
</head>
<body>


<main>
    <section>
        <h2>Our Mission</h2>
        <p>Our mission is to bridge the gap between job seekers and employers, providing a platform where individuals can explore career opportunities and businesses can find the right talent.</p>
        
        <h2>Our Vision</h2>
        <p>We envision a world where job searching and hiring processes are simplified, efficient, and accessible to everyone. Our weblog is designed to make this vision a reality.</p>
        
        <h2>Project Details</h2>
        <p>This weblog is the result of a dedicated effort by the researcher as part of our Final Year Project (FYP). It represents his commitment to creating a valuable resource for both job seekers and employers.</p>
    </section>
</main>

<!-- Add your JavaScript and other scripts here -->
</body>
</html>
@endsection