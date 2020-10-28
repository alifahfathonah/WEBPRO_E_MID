<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    // App\Http\Controllers\AnswerController
    /**
     * Display latest 5 answer that made by user using paginate.
     */
    public function showAnswer()
    {
        $lista=Answer::where('user_id', auth()->id())->orderByRaw('created_at DESC')->paginate(5);

        return view('answers/answer',compact('lista'));
    }

    // App\Http\Controllers\AnswerController
    /**
     * Store a newly created resource in storage.
     */
    public function store($question_id, Request $request)
    {
        // Check if answer is not empty
        $request->validate([
            "answer" => "required",
        ]);

        // Save answer to db
        Answer::create([
            'answer' => $request->answer,
            'question_id' => $question_id,
            'user_id' => Auth::user()->id,
        ]);

        // Redirect the user back to the forum
        return redirect("/forum/$question_id")->with(
            'status',
            'Answer Posted Successfully'
        );
    }

    // App\Http\Controllers\AnswerController
    /**
     * Display the specified resource.
     */
    public function edit(Answer $answer)
    {
        // Return answer edit form with previous answer
        return view('answers.edit', compact('answer'));
    }

    // App\Http\Controllers\AnswerController
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Answer $answer)
    {
        // Check if answer is not empty
        $request->validate([
            "editanswer" => "required",
        ]);

        // Edit answer record in db
        Answer::find($answer->id)->update([
            'answer' => $request->editanswer,
        ]);

        // Redirect the user back to the forum
        return redirect("/forum/$answer->question_id")->with(
            'status',
            'Updated Successfully'
        );
    }

    // App\Http\Controllers\AnswerController
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        // Delete answer record in db
        Answer::destroy($answer->id);

        // Redirect the user back to the forum
        return redirect("/forum/{$answer->question_id}")->with(
            'status',
            'Deleted Successfully'
        );
    }
}
