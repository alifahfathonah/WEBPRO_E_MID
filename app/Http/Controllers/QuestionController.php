<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    //Display latest 5 question
    public function index()
    {
        //
        $question=Question::orderByRaw('created_at DESC')->paginate(5);
        return view('questions/index',compact('question'));
    }

    //Display questions made by user
    public function showQuestion()
    {
        //
        $listq=Question::where('user_id', auth()->id())->orderByRaw('created_at DESC')->paginate(5);
        return view('questions/question',compact('listq'));
    }

    // App\Http\Controllers\QuestionController
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return question create form
        return view('questions/create');
    }

    // App\Http\Controllers\QuestionController
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Check if question is not empty
        $request->validate([
            "question" => "required",
            "detail_question" => "required",
        ]);

        // Save question to database
        Question::create([
            'question' => $request->question,
            'detail_question' => $request->detail_question,
            'user_id' => Auth::user()->id
        ]);

        // Redirect the user back to the forum with a status message
        return redirect('/forum')->with('status','Question Posted Successfully');
    }

    // App\Http\Controllers\QuestionController
    // Show a specific question
    public function show(Question $question)
    {
        //
        return view('questions.show',compact('question'));
    }

    // App\Http\Controllers\QuestionController
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        // Return question edit form with previous question
        return view('questions.edit',compact('question'));
    }

    // App\Http\Controllers\QuestionController
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question)
    {
        // Check if question is not empty
        $request->validate([
            "question" => "required",
            "detail_question" => "required",
        ]);

        // Edit question record in database
        Question::where('id',$question->id)
            ->update([
                'question' => $request->question,
                'detail_question' => $request->detail_question,
            ]);

        // Redirect the user back to the question page with a status message
        return redirect("/forum/$question->id")->with('status','Updated successfully');
    }

    // App\Http\Controllers\QuestionController
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        // Delete question record in database
        Question::destroy($question->id);

        // Redirect the user back to the forum with a status message
        return redirect("/forum")->with('status','Deleted Successfully');
    }

    // App\Http\Controllers\QuestionController
    /**
     * Search for specified resource(s) from storage.
     */
    public function search(Request $request)
    {
        // Check if keyword is not empty
        $request->validate([
            "keyword" => "required",
        ]);

        // Search question record in database
        $question=Question::where('question','like',"%$request->keyword%")
            ->orderByRaw('created_at DESC')
            ->paginate(5);

        $keyword=$request->keyword;

        // Return to the forum with requested keyword question
        return view('questions.index',compact('question','keyword'));
    }
}
