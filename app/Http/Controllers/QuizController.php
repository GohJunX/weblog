<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        $layout = (Auth::check() && Auth::user()->u_role === 'job_seeker') ? 'layouts.app' : 'layouts.appAdmin';
        return view('quiz.homeQuiz', compact('quizzes','layout'));
    }

    public function show(Quiz $quiz)
    {
        $layout = (Auth::check() && Auth::user()->u_role === 'job_seeker') ? 'layouts.app' : 'layouts.appAdmin';
        $questions = $quiz->questions()->with('options')->get();
        return view('quiz.viewQuiz', compact('quiz', 'questions','layout'));
    }

 

    public function submit(Request $request, Quiz $quiz)
    {
        // Validate the form submission (if necessary)
        $request->validate([
            // Add validation rules for the answers if needed
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
    
        // Check if the user has already completed the quiz
        if ($user->quizzes->contains($quiz)) {
            // User has already completed the quiz, so return the existing score
            $existingScore = $user->quizzes->find($quiz)->pivot->score;
            return view('quiz.score', compact('existingScore'));
        }
    
        // Calculate the user's score based on the submitted answers
        $score = 0;
        foreach ($quiz->questions as $question) {
            $userAnswer = $request->input('question_' . $question->id);
            $correctOption = $question->options->where('is_correct', true)->first();
    
            if ($userAnswer == $correctOption->id) {
                $score++;
            }
        }
    
        // Calculate the percentage score
        $totalQuestions = count($quiz->questions);
        $percentageScore = ($score / $totalQuestions) * 100;
    
        // Save the user's score and completion status in the pivot table 'quiz_user'
        $user->quizzes()->attach($quiz, ['score' => $percentageScore, 'completed' => true]);
    
        // Pass the percentage score to the view
        return view('quiz.score', compact('percentageScore'));
    }
    public function create()
    {
        return view('quiz.createQuiz');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'questions' => 'required|array',
            'questions.*' => 'required|string',
            'options.*' => 'required|array|min:2',
            'options.*.*' => 'required|string',
            'correct_answers.*' => 'required|integer|min:0|max:3', // Assuming the correct_answers array contains integers (0 to 3)
        ], [
            'title.required' => 'The quiz title is required.',
            'questions.required' => 'At least one question is required.',
            'questions.*.required' => 'Please provide a question text for all questions.',
            'options.*.required' => 'Each question must have at least two options.',
            'options.*.*.required' => 'Please provide an option text for all options.',
            'correct_answers.*.required' => 'Please select a correct answer for all questions.',
            'correct_answers.*.integer' => 'Correct answer indices must be integers.',
            'correct_answers.*.min' => 'Invalid correct answer index.',
            'correct_answers.*.max' => 'Invalid correct answer index.',
        ]);
    
        $quiz = Quiz::create([
            'title' => $request->title,
        ]);
    
        // Loop through each question and its options
        foreach ($request->questions as $index => $questionText) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $questionText,
            ]);
    
            foreach ($request->options[$index] as $optionIndex => $optionText) {
                $isCorrect = ($optionIndex == $request->correct_answers[$index]);
                $question->options()->create([
                    'option_text' => $optionText,
                    'is_correct' => $isCorrect,
                ]);
            }
        }
    
        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
    }
}
