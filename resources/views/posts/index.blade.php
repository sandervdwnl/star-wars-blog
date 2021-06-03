<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2>Blog</h2>

                    @auth
                    <a href="{{ url('posts/create') }}" class="btn btn-secondary mr-2">Create A New Post</a>
                    @endauth

                    @if (isset($message))
                    <p class="bg-info mt-2 text-center p-2">
                        <b>{{ $message }}</b>
                    </p>
                    @endif

                    {{-- $posts from index() of PostController --}}

                    <div class="container">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            @foreach ($posts as $post)
                            <div class="postcard mt-12">
                                @if( ( $post->featured_image ) == 'img/')
                                <img src="{{ URL::asset('img/placeholder-image.png') }}" alt="" title="">
                                @else
                                {{-- img found --}}
                                <img class="postcard-img" src="{{ url('/' . $post->featured_image . '_thumb.jpg') }}" alt="Card image cap">
                                @endif
                                <div class="postcard-body">
                                    <h5 class="postcard-title pt-6 pb-2 font-lg font-extrabold">{{ $post->title }}
                                        @auth
                                        @if( $post->featured == 1 )
                                        <i class="fas fa-star text-yellow-300"></i>
                                        @endif
                                        @endauth
                                    </h5>
                                    <p><small><b>By:</b> {{ ucfirst($post->author) ?? 'unknown' }} <b>Published</b> {{ $post->created_at->diffForHumans() }}</small></p>
                                    <p class="postcard-text">{{ Str::words( $post->content, 25 ) }}</p>
                                    <a href="/posts/{{ $post->id }}" class="bg-green-300 font-bold text-gray-500 py-2 px-4 rounded shadow hover:bg-green-200"><i class="fas fa-book-reader"></i> Read</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
    </div>
</x-guest-layout>
