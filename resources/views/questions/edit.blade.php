@extends('layouts/app')

@section('content')
    <div class="container">
        <h2>Edit Question</h2>
        <form action='{{url("/forum/$question->id")}}/update' method="POST">
            @csrf
            <div class="form-group">
                <label for="question">Question</label>
                <input type="textfield" class="form-control" id="question" name="question" rows="3" value="{{$question->question}}">
            </div>

            <div class="form-group">
                <label for="detail_question">Detail Question</label>
                <textarea class="form-control" id="detail_question" name="detail_question" rows="3">{{$question->detail_question}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>
@endsection
