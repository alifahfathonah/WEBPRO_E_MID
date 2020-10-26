<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store($question_id, Request $request)
    {
        $request->validate([
            "answer" => "required",
        ]);

        Answer::create([
            'answer' => $request->answer,
            'question_id' => $question_id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect("/forum/$question_id")->with(
            'status',
            'Answer Posted Successfully'
        );
    }

    /**
     * Display the specified resource.
     */
    public function edit(Answer $answer)
    {
        return view('answers.edit', compact('answer'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, Answer $answer)
    {
        $request->validate([
            "editanswer" => "required",
        ]);
        /*
        $validator = Validator::make($request->all(), [
            "editanswer" => "required",
        ]);

        if ($validator->fails()) {
            return redirect("/forum/$answer->question_id")
                        ->withErrors($validator)
                        ->with('status','Update unsuccessfull');
        }
 */
        Answer::find($answer->id)->update([
            'answer' => $request->editanswer,
        ]);

        return redirect("/forum/$answer->question_id")->with(
            'status',
            'Updated Successfully'
        );
    }
}
