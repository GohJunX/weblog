@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
    }

    .container {
        margin-left: 200px;
        margin-top: 50px;
        max-width: 70%;
    }

    .email-container {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .email-info h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .email-info-row {
        margin-bottom: 10px;
    }

    .email-info-row strong {
        display: inline-block;
        width: 150px;
    }

    .email-info-row a {
        margin-top: 5px;
    }

    .img-fluid {
        max-width: 200px;
        max-height: 200px;
    }

    .buttons {
        margin-top: 20px;
    }

    .cancel-btn {
        margin-right: 10px;
    }

    /* Additional style for the content box */
    .content-box {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }
</style>

<div class="container" >
    <div class="email-container">
        <div class="email-info">
            <h1>Email Detail</h1>
            <div class="row">
                <div class="col-md-6" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
                    <div class="email-info-row">
                        <strong>Email:</strong>
                        <span>{{ $email->sender->email }}</span>
                    </div>
                    <div class="email-info-row">
                        <strong>From:</strong>
                        <a href="/profile/show/{{$email->sender->id}}"><span>{{ $email->sender->name }}</span></a>
                    </div>
                    <div class="email-info-row">
                        <strong>Title:</strong>
                        <span>{{ $email->job->jp_pos }}</span>
                    </div>
                    <div class="email-info-row">
                        <strong>To:</strong>
                        <span>{{ $user->name }}</span>
                    </div>
                    @if($email->n_interview_time)
                    <div class="email-info-row">
                        <strong>Reschedule:</strong>
                        <span>{{ $email->n_interview_time }}</span>
                    </div>
                    @endif
                    @if($email->n_resume_file_path)
                    <div class="email-info-row">
                        <strong>Resume:</strong>
                        <a href="{{ asset($email->n_resume_file_path) }}" target="_blank" class="mt-2 btn btn-primary">Download Resume</a>
                    </div>
                    @endif
                   
                </div>
                <div class="col-md-6" >
                    @if($email->n_profile_pic_file_path)
                    <div class="email-info-row">
                        <img src="{{ asset($email->n_profile_pic_file_path) }}" alt="Profile Picture" class="mt-2 img-fluid" id="profile_picture_preview" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
                    </div>
                    @endif
                </div>
            </div>
          
            <div class="content-box mt-4" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
                <strong>Content:</strong>
                <p>{{ $email->n_content }}</p>
            </div>
        </div>
        <div class="buttons mt-4">
            <a href="{{ route('notification.index') }}" class="cancel-btn btn btn-secondary">Cancel</a>
            <a href="{{ route('notificationget.reply', $email->n_id) }}" class="reply-btn btn btn-primary">Reply</a>
        </div>
    </div>
</div>
@endsection
