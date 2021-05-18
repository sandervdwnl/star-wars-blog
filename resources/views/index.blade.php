@extends('layouts.bootstrap')

@section('title', 'Homepage')

@section('content')
<h1 class="text-center">This is the blog page</h1>

<div class="container">
    <div class="row">

        @foreach ($posts as $post)
        <div class="col-3">
            <div class="card" style="width: 18rem;">
                @if( empty( $post->featured_image ))
                <img src="{{ URL::asset('img/placeholder-image.png') }}" alt="" title="">
                @else
                {{-- img found --}}
                <img class="card-img-top" src="{{ $post->featured_image }}" alt="Card image cap">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::words( $post->content, 25 ) }}</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
