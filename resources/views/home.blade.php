<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts Page') }}
        </h2>
    </x-slot>
    <div class="p-6 bg-white border-b border-gray-200">

        <h2>Posts Page</h2>

        <div class="row mt-2">

            {{-- sue $posts from index() of PostController --}}
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
                        <p><small><b>By:</b> {{ $post->author ?? 'unknown' }}</small></p>
                        <p class="card-text">{{ Str::words( $post->content, 25 ) }}</p>
                        <a href="/posts/{{ $post->id }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
    </div>
    </div>
    </x-app-layout>
