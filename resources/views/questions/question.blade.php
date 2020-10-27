@extends('layouts/app')

@section('content')
    <div class="container">
        <h2>List of Questions</h2>

        <div class="list-group mt-3">
            @forelse($listq as $i)
                <a href='{{url("forum/$i->id")}}' class="list-group-item list-group-item-action">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="mb-1">{{ Str::limit($i->question, 16, $end='...') }}</h5>
                        </div>
                        <div class="col-lg-6 text-right">
                            <small>Upload : {{$i->created_at}} - Edited : {{$i->updated_at}}</small>
                        </div>

                        
                    </div>
                </a>
            @empty
                <div class="list-group-item disabled text-center font-italic">
                    No Data Available
                </div>
            @endforelse
            <div class="mt-3">
                {{ $listq->links() }}
            </div>
        </div>
    </div>
@endsection
