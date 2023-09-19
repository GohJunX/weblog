@extends('layouts.appAdmin')

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

        h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input.form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        input.form-control:focus {
            border-color: #007bff;
        }

        .option-container {
            display: flex;
            align-items: center;
        }

        .option-container label {
            flex: 1;
        }

        .option-container input {
            flex: 3;
            margin-right: 10px;
        }

        .option-container input[type="radio"] {
            flex: 1;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        hr {
            margin: 20px 0;
            border: none;
            border-top: 1px solid #ddd;
        }
    </style>
    <div class="container">
        <h1>Create New Quiz</h1>

        <form action="{{ route('quizzes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title" style="font-size:20px">Quiz Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <h3>Questions</h3>
            <div id="questions-container">
                <!-- The first question input fields -->
                <div class="question-container form-group">
                <button type="button" class="btn btn-danger delete-question-btn" onclick="deleteQuestionAndOptions(this.parentElement)">Delete Question</button>
                    <label for="question">Question 1</label>
                    <input type="text" name="questions[]" class="form-control" required>
                   
                    <div style="margin:10px"></div>
                    <!-- The option input fields for Question 1 -->
                    <div class="option-container form-group">
                        <label for="option1">Option 1</label>
                        <input type="text" name="options[0][]" class="form-control" required>
                        <input type="radio" name="correct_answers[0]" value="0" required> Correct
                    </div>
                    <div class="option-container form-group">
                        <label for="option2">Option 2</label>
                        <input type="text" name="options[0][]" class="form-control" required>
                        <input type="radio" name="correct_answers[0]" value="1" required> Correct
                    </div>
                    <div class="option-container form-group">
                        <label for="option3">Option 3</label>
                        <input type="text" name="options[0][]" class="form-control" required>
                        <input type="radio" name="correct_answers[0]" value="2" required> Correct
                    </div>
                    <div class="option-container form-group">
                        <label for="option4">Option 4</label>
                        <input type="text" name="options[0][]" class="form-control" required>
                        <input type="radio" name="correct_answers[0]" value="3" required> Correct
                    </div>
                </div>
            </div>

            <button type="button" id="add-question-btn" class="btn btn-secondary">Add Question</button>
            <button type="submit" class="btn btn-primary">Create Quiz</button>
        </form>
    </div>


    <script>
    let questionIndex = 2;

    function addQuestion() {
        const questionsContainer = document.querySelector('#questions-container');

        const questionContainer = document.createElement('div');
        questionContainer.className = 'question-container form-group';

        // Add the delete question button
        const deleteQuestionButton = document.createElement('button');
        deleteQuestionButton.type = 'button';
        deleteQuestionButton.className = 'btn btn-danger delete-question-btn';
        deleteQuestionButton.textContent = 'Delete Question';
        deleteQuestionButton.addEventListener('click', () => deleteQuestionAndOptions(questionContainer));

        questionContainer.appendChild(deleteQuestionButton);

        // Add the question label and input
        const questionLabel = document.createElement('label');
        questionLabel.textContent = `Question ${questionIndex}`;
        const questionInput = document.createElement('input');
        questionInput.type = 'text';
        questionInput.name = 'questions[]';
        questionInput.className = 'form-control';
        questionInput.required = true;

        questionContainer.appendChild(questionLabel);
        questionContainer.appendChild(questionInput);

        // Add the option input fields and correct answer radio buttons for the new question
        for (let i = 1; i <= 4; i++) {
            const optionContainer = document.createElement('div');
    optionContainer.className = 'option-container form-group';
    optionContainer.style.marginTop = '10px'; // Add top margin

            const optionLabel = document.createElement('label');
            optionLabel.textContent = `Option ${i}`;
            const optionInput = document.createElement('input');
            optionInput.type = 'text';
            optionInput.name = `options[${questionIndex - 1}][]`;
            optionInput.className = 'form-control';
            optionInput.required = true;

            const optionRadio = document.createElement('input');
            optionRadio.type = 'radio';
            optionRadio.name = `correct_answers[${questionIndex - 1}]`;
            optionRadio.value = i - 1;
            optionRadio.required = true;

            const optionRadioLabel = document.createElement('span');
            optionRadioLabel.textContent = ' Correct';

            optionContainer.appendChild(optionLabel);
            optionContainer.appendChild(optionInput);
            optionContainer.appendChild(optionRadio);
            optionContainer.appendChild(optionRadioLabel);

            questionContainer.appendChild(optionContainer);
        }

        const hr = document.createElement('hr');
        questionsContainer.appendChild(hr);

        questionsContainer.appendChild(questionContainer);

        questionIndex++;
    }

    function deleteQuestionAndOptions(questionContainer) {
        if (questionIndex > 2) {
            questionContainer.remove();
            questionIndex--;

            const questionsContainer = document.querySelector('#questions-container');
            const horizontalLines = questionsContainer.querySelectorAll('hr');
            if (horizontalLines.length > 0) {
                horizontalLines[horizontalLines.length - 1].remove();
            }
        } else {
            alert('At least one question must remain.');
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const addQuestionButton = document.querySelector('#add-question-btn');
        addQuestionButton.addEventListener('click', addQuestion);

        const initialQuestion = document.querySelector('.question-container');
        initialQuestion.querySelector('label').textContent = 'Question 1';
    });
</script>
@endsection