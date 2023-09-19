@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Reply</title>
    <style>
         body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #1e88e5;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>

</head>
<body>
    <div class="container" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
        <h1>Reply</h1>

        <form action="{{ route('notificationJpost.reply',$id=$email->n_id)}}" method="POST">
            @csrf

            <div class="form-group" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                <label for="content">Content:</label>
                <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                <label for="interview_time">Interview Time:</label>
                <input type="datetime-local" name="interview_time" id="interview_time" class="form-control">
            </div>

            <button type="submit" class="btn" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); ">Send</button>
        </form>
    </div>
</body>
</html>
@endsection