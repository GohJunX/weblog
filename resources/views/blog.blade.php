@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>

<head>
    <title>Blog Home</title>

    <style>
        body,
        h1,
        h2,
        h3,
        p,
        img,
        form,
        input,
        button,
        a {
            margin: 0;
            padding: 0;
        }

        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            line-height: 1.5;
            color: #333;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 8px 10px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            padding: 8px 16px;
            background-color: black;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        main {
            padding: 20px;
        }

        .recommended-blogs {
            margin-bottom: 20px;
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .blog-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .blog {
            flex-basis: 30%;
            background-color: #fff;
            padding: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            font-weight: bold;
            color: black;
            display: inline-block;
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .blog:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .blog img {
            width: 100%;
            height: auto; /* Maintain aspect ratio */
            max-height: 200px; /* Set a fixed height */
            margin-bottom: 10px;
        }

        .blog h3 {
            font-size: 16px;
            font-weight: bold;
        }

        .write-blog-button {
            display: inline-block;
            padding: 10px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            float: right;
        }
    </style>
</head>

<body>

    <main>
        <a href="{{ route('blog.create') }}" class="write-blog-button" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">Write Your Blog</a>
        <form action="{{ route('blog.search') }}" method="GET">
            <input type="text" name="search" placeholder="Search blogs..." style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
            <button type="submit" >Search</button>
        </form>
        <section class="recommended-blogs">
            <h2>Recommended Blogs</h2>
            <div class="blog-list">
                @foreach($recommendedBlogs as $blog)
                <a href="{{ route('blog.show', $blog->blog_id) }}" class="blog">
                    @if($blog->blog_interface_img_file_path)
                    <img src="{{ asset($blog->blog_interface_img_file_path) }}" >
                    @else
                    <img src="{{ asset('images/boss-thumbs-up-employee.jpg') }}" >
                    @endif
                    <h1>{{ $blog->blog_title }}</h1>
                </a>
                @endforeach
            </div>
        </section>
    </main>

</body>

</html>

@endsection