<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // public function store(Quiz $quiz, Request $request)
    // {
    //     $request->validate([
    //         'question_text' => 'required|string',
    //         'options' => 'required|array|min:2',
    //         'options.*.option_text' => 'required|string',
    //         'correct_option' => 'required|integer|between:0,' . (count($request->options) - 1),
    //     ]);

    //     $question = new Question([
    //         'question_text' => $request->question_text,
    //     ]);

    //     $quiz->questions()->save($question);

    //     foreach ($request->options as $key => $optionData) {
    //         $option = new Option([
    //             'option_text' => $optionData['option_text'],
    //             'is_correct' => $key == $request->correct_option,
    //         ]);

    //         $question->options()->save($option);
    //     }

    //     return redirect()->route('quizzes.show', $quiz)->with('success', 'Question added successfully!');
    // }
}
