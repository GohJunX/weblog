@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
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

        ul {
            list-style: none;
            padding: 0;
        }

        #list {
            margin-bottom: 10px;
        }

        .sender {
            font-weight: bold;
        }

        #a-view-email {
            color: #ff0000;
            font-weight: bold;
            text-decoration: underline;
        }

        #a-view-email:hover {
            color: #990000;
        }
        .custom-list-item {
        padding: 10px;
        }

        .title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        }

        .name {
        font-size: 14px;
        color: #999999;
        margin-bottom: 0;
        }

        .view-email-btn {
        margin-left: 10px;
        }
    </style>
</head>
<body>
<div class="container" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
    <h1 class="mb-4">Notification</h1>

   <ul class="list-group" >
    @foreach ($emails as $email)
    @if ($email->user->id === $users->id)
    <li id="list" class="list-group-item d-flex justify-content-between align-items-center custom-list-item" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);margin-bottom:10px;">
        <div>
            <h5 class="title">Title: <span class="sender">{{ $email->job->jp_pos }}</span></h5>
            <p class="name"><span class="sender">{{ $email->sender->name }}</span> (Employer) sent you an email for the job application.</p>
        </div>
        <a href="{{ route('notificationJ.show', $email->n_id) }}" id="view-email" class="btn btn-primary view-email-btn">View Email</a>
    </li>
    @endif
    @endforeach
</ul>
</div>
</body>
</html>
@endsection