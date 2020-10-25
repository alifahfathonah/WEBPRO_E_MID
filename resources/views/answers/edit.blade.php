@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Answer</h3>
        <form action='{{url("/forum/answer/$answer->id")}}/update' method="POST">
            @csrf

            <div class="form-group">
                <label for="editanswer">Answer</label>
                <textarea class="form-control" id="editanswer" name="editanswer" rows="3">{{$answer->answer}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Post</button>
        </form>

    </div>
@endsection
