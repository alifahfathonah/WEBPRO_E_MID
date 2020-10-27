@extends('layouts/app')

@section('content')
    <div class="container mt-3">
        <a href="{{url('/forum/create')}}" class="btn btn-primary d-inline">Add New Question</a>

        <form method="post" action='{{url("/forum/search")}}' class="d-inline form-inline ml-5">
            @csrf
            <input type="text" class="form-control w-50 @error('keyword') is-invalid @enderror" id="keyword" name="keyword" placeholder="Keyword" value="@isset($keyword){{$keyword}}@endisset">

            <button type="submit" class="btn btn-success ml-2">Search</button>
        </form>
        @if (session('status'))
            <div class="alert alert-warning mt-3">
                {{ session('status') }}
            </div>
        @endif

        <div class="list-group mt-4">
            @forelse($question as $i)
           
                <a href='{{url("forum/$i->id")}}' class="list-group-item list-group-item-action">
                    
                    <div class="row">
                        <div class="col-lg-3">
                            <h5 class="mb-1">{{ Str::limit($i->question, 16, $end='...') }}</h5>
                        </div>
                        <div class="col-lg-9 text-right">
                            <small>Upload : {{$i->created_at}} - Edited : {{$i->updated_at}} by : {{$i->user->username}}</small>
                        </div>

                    </div>
                    
                </a>
            @empty
                <div class="list-group-item disabled text-center font-italic">
                    No Data Available
                </div>
            @endforelse
            <div class="mt-3">
                {{ $question->links() }}
            </div>
        </div>
    </div>
@endsection
