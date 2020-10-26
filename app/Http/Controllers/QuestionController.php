<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questions/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "question" => "required",
            "detail_question" => "required",
        ]);

        Question::create([
            'question' => $request->question,
            'detail_question' => $request->detail_question,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/forum')->with('status','Question Posted Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('questions.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            "question" => "required",
            "detail_question" => "required",
        ]);
        // $validator = Validator::make($request->all(), [
        //     "question" => "required",
        //     "detail_question" => "required",
        // ]);

        // if ($validator->fails()) {
        //     return redirect()
        //                 ->back()
        //                 ->withErrors($validator)
        //                 ->with('status','Update unsuccessfull');
        // }
        Question::where('id',$question->id)
            ->update([
                'question' => $request->question,
                'detail_question' => $request->detail_question,
            ]);

        return redirect("/forum/$question->id")->with('status','Updated successfully');
    }
}
