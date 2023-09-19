@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.5;
        background-color: #f5f5f5;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
    }

    p {
        font-size: 20px;
        margin-bottom: 30px;
    }

    .message {
        font-size: 18px;
        color: #999999;
    }
</style>
<div class="container">
    <h1>Your Quiz Score</h1>

    @if(isset($percentageScore))
    <p>Your score: <strong>{{ $percentageScore }}%</strong></p>
    @elseif(isset($existingScore))
    <p>You have already completed the quiz. Your score: <strong>{{ $existingScore }}%</strong></p>
    @else
    <p class="message">Oops! Something went wrong. Unable to retrieve your quiz score.</p>
    @endif

    <!-- Add any additional content you want to show to the user -->
</div>
@endsection