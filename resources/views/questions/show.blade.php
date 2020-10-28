@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$question->question}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Upload : {{$question->created_at}} - Edited : {{$question->updated_at}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">Author : {{$question->user->name}}</h6>
                        <p class="card-text" style="white-space: pre-line;">{{$question->detail_question}}</p>

                        @if(Auth::user()->id === $question->user_id)
                            <form action='{{url("/forum/$question->id")}}' method="post" class="d-inline">
                                @method('patch')
                                @csrf
                                <button type="submit" class="btn btn-success">Edit</button>
                            </form>

                            <form method="post" action='{{url("/forum/$question->id")}}' class="d-inline ml-3">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-warning mt-3">
                {{ session('status') }}
                @error('question')
                    <br>{{ $message }}
                @enderror

                @error('editanswer')
                    <br>The answer field is required.
                @enderror
            </div>
        @endif
        <div class="row mt-2">
            <div class="col">
                <form action='{{url("/forum/$question->id")}}' method="POST">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="3"></textarea>
                        @error('answer')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            </div>
        </div>

        @foreach($question->answers as $i)
        <div class="row mt-4">
            <div class="col">
                <div class="card text-right">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Upload : {{$i->created_at}} - Edited : {{$i->updated_at}}</h6>
                        <h6 class="card-subtitle mb-2 text-muted">By : {{$i->user->name}}</h6>
                        <p class="card-text" style="white-space: pre-line;">{{$i->answer}}</p>
                        @if(Auth::user()->id === $i->user_id)
                            <form action='{{url("/forum/answer/$i->id")}}' method="post" class="d-inline">
                                @method('patch')
                                @csrf
                                <button type="submit" class="btn btn-success">Edit</button>
                            </form>
                            <form method="post" action='{{url("/forum/answer/$i->id")}}' class="d-inline ml-3">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
@endsection
