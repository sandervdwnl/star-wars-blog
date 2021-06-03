<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Homepage Page') }}
        </h2>
    </x-slot>

    <div class="h-72 lg:h-96 m-0 flex flex-col items-center justify-center bg-center sm:bg-top" id="hero">
        <h1 class="text-green-300 block">Star Wars Blog</h1>
        <h2 class="text-green-100 block text-lg">Latest Star Wars news and facts</h2>
    </div>

    <div class="container flex p-6 sm:py-12 lg:py-16">
        <div class="flex items-center justify-center w-1/2 p-4">
            <h2 class="text-base lg:text-lg 2xl:text-2xl font-semibold">Do you like Star Wars? Read the latest Star Wars news and fact in the blog</h2>
        </div>
        <div class="flex items-center justify-center w-1/2">
            <a href="/posts" class="bg-green-300 font-bold text-gray-500 py-2 lg:py-4 px-4 lg:px-8 rounded shadow hover:bg-green-200"><i class="fas fa-angle-double-right"></i>
                To the blog</a>
        </div>
    </div>

    <div id="stormtroopers">
        <img src="/img/hero-1.jpg" alt="" id="stormtrooper-banner">
    </div>

    <h2 class="text-green-300 block text-2xl my-4 font-bold text-center lg:py-4 lg:px-8">Featured Posts</h2>

    <div class="container">
        <div id="featured-posts" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($posts as $post)
            <div class="post-card">
                @if( ( $post->featured_image ) == 'img/')
                <img src="{{ URL::asset('img/placeholder-image.png') }}" alt="" title="">
                @else
                {{-- img found --}}
                <img class="card-img-top" src="{{ url('/' . $post->featured_image . '_thumb.jpg') }}" alt="Card image cap">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p><small><b>By:</b> {{ ucfirst($post->author) ?? 'unknown' }}</small></p>
                    <p class="card-text">{{ Str::words( $post->content, 25 ) }}</p>
                    <a href="/posts/{{ $post->id }}" class="bg-green-300 font-bold text-gray-500 py-2 px-4 rounded shadow hover:bg-green-200"><i class="fas fa-book-reader"></i> Read</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</x-guest-layout>
