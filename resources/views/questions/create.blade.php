@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{url('forum')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="question">Question</label>
                <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" placeholder="Type your question here" value="{{old('question')}}">
                @error('question')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="detail_question">Describe your question</label>
                <textarea class="form-control @error('detail_question') is-invalid @enderror" id="detail_question" name="detail_question" rows="3">{{old('detail_question')}}</textarea>
                @error('detail_question')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Post</button>
        </form>
    </div>
@endsection