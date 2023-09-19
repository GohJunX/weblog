@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Email Detail</title>
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
            background-color: #fff;
            position: relative;
        }

        .email-box h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        
        .email-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 60%;
            position: relative; /* Add relative positioning to the email-box */
        }

        .email-info-row {
            margin-bottom: 10px;
        }

        .email-info-row strong {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }

        .content-box {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            margin-top: 15px;
        }

        .buttons {
            margin-top: 20px;
        }

        .cancel-btn,
        .reply-btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        .cancel-btn {
           
            margin-right: 10px;
            
        }

        .reply-btn {
            background-color: #1e88e5;
        }

        .img-fluid {
            max-width: 200px;
            max-height: 200px;
            position: absolute; /* Add absolute positioning to the image */
            top: 20px; /* Position it at the top */
            right: 200px; /* Position it at the right */
        }
    </style>
</head>
<body>
    <div class="container" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
        <div class="email-box">
            <h1>Email Detail</h1>
            <div class="email-info-row">
                <strong>Email:</strong>
                <span>{{ $email->sender->email }}</span>
            </div>
            <div class="email-info-row">
                <strong>From:</strong>
                <a href="/profileEmp/show/{{$email->sender->id}}"><span>{{ $email->sender->name }}</span></a>
            </div>
            @if($email->n_interview_time)
            <div class="email-info-row">
                <strong>Interview Time:</strong>
                <span>{{ $email->n_interview_time }}</span>
            </div>
            @endif
            <div class="email-info-row">
                <strong>To:</strong>
                <span>{{ $email->user->name }}</span>
            </div>
           
        </div>
        @if($email->sender->u_profile_pic)
            <!-- Move the image inside the email-info-row -->
            <div class="email-info-row" >
                <img src="{{ asset($email->sender->u_profile_pic) }}" alt="Profile Picture" class="mt-2 img-fluid" id="profile_picture_preview" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px; ">
            </div>
            @endif
            <div class="content-box mt-4" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 10px;">
                <strong>Content:</strong>
                <p>{{ $email->n_content }}</p>
            </div>
            <div class="buttons">
                <a href="{{ route('notificationJ.index') }}" class="cancel-btn btn btn-secondary">Cancel</a>
                <a href="{{ route('notificationJget.reply', $email->n_id) }}" class="reply-btn btn btn-primary">Reply</a>
            </div>
    </div>
</body>
</html>
@endsection