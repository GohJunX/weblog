@extends($layout)

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
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3);
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
    }

    h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin-bottom: 20px;
    }

    #list {
        margin-bottom: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        font-size: 18px;
        cursor: pointer;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 4px;
    }

    input[type="radio"] {
        margin-right: 10px;
        cursor: pointer;
    }

    button {
        display: block;
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 18px;
        background-color: #007BFF;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
     
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
<div class="container">
    <h1>{{ $quiz->title }}</h1>

    <form action="{{ route('quizzes.submit', $quiz) }}" method="POST">
        @csrf
        @foreach($questions as $question)
            <div class="question-box">
                <h3>{{ $question->question_text }}</h3>
                <ul>
                    @foreach($question->options as $option)
                        <li id="list">
                            <label>
                                <input type="radio" name="question_{{ $question->id }}" value="{{ $option->id }}">
                                {{ $option->option_text }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
        @if(Auth::user()->u_role !== 'admin')
        <button type="submit" class="btn btn-primary">Submit Quiz</button>
        @endif
    </form>
</div>
@endsection
