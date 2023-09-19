@extends($layout)

@section('title', 'Quizzes')

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
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0;
        
    }

    #list {
        margin-bottom: 15px;
        
    }

    a {
        color: #007bff;
        text-decoration: none;
    }



    .create-button {
        display: block;
        margin-top: 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }

    .create-button:hover {
        background-color: #0056b3;
    }
</style>
    <div class="container">
        <h1>Quizzes</h1>
        <ul>
            @foreach($quizzes as $quiz)
                <li id="list">
                    <a href="{{ route('quizzes.show', $quiz) }}">{{ $quiz->title }}</a>
                </li>
            @endforeach
        </ul>
        @if(Auth::user()->u_role === 'admin')
        <div>
            <a href="/quizzes/create"><button class="create-button">Create Quizzes</button></a>
        </div>
        @endif
    </div>
@endsection
