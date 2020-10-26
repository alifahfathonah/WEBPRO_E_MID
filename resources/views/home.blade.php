@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Featured') }}</div>

                <div class="card-body">
                    <h5 class="card-title">Forum</h5>
                    <p class="card-text">Let's discuss together</p>
                    <a href="{{url('/forum')}}" class="btn btn-primary">Enter Forum</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
