<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Single Posts Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <div class="container inline-flex pl-0
                    ">

                        @if(isset( $message))
                        {{ $message }}
                        @endif

                        @auth
                        <a class="btn btn-warning mr-2" href="http://127.0.0.1:8000/posts/{{ $post->id }}/edit">Edit</a>

                        <form action="/posts/{{ $post->id }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>

                        @if (isset($message)) <p class="bg-info mt-2 text-center p-2">
                            <b>{{ $message }}</b>
                        </p>
                        @endif

                    </div>
                    @endauth

                    <div class="row mt-2">

                        {{-- sue $posts from index() of PostController --}}

                        <div class="col-md-8 offset-md-2">
                            <div class="post">
                                @if( empty( $post->featured_image ))
                                <img src="{{ URL::asset('img/placeholder-image.png') }}" alt="" title="">
                                @else
                                {{-- img found --}}
                                <img class="card-img-top" src="{{ asset('storage/') . '/' . $post->featured_image }}" alt="Card image cap">
                                @endif
                                <div class="card-body">
                                    <h3 class="card-title text-center">{{ $post->title }}</h5>
                                        <p><small><b>By:</b> {{ $post->author ?? 'Unknown' }} <b>Published</b> {{
                                                $post->created_at->diffForHumans() }}</small></p>
                                        <p class="card-text">{{ $post->content }}</p>
                                </div>
                            </div>
                        </div>

                        <h2 class="block w-full text-center mt-8">Leave A Comment</h2>

                        <div class="comments-form col-md-8 offset-md-2">
                            <form action="/comments" method="POST">
                                @csrf
                                <label for="author">Name</label>
                                <input type="text" name="author" id="author" value="" class="form-control">
                                <label for="comment">Comment</label>
                                <textarea name="comment" id="comment" cols="30" rows="10" class="form-control">
                                </textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="submit" value="Submit Comment" class="bg-green-300 mt-4 font-bold text-gray-500 py-2 px-4 rounded shadow hover:bg-green-200">
                            </form>
                        </div>

                        <h2 class="block w-full text-center mt-8">Comments</h2>

                        <div class="comments-form col-md-8 offset-md-2">
                            @if(isset($comment))

                            @foreach ($comment as $comment)
                            <p class="author"><b>Written by {{ $comment->author  }}</b> {{ $comment->created_at->diffForHumans() }}
                            </p>
                            <p class="comment">{{ $comment->comment }}</p>
                            @endforeach

                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </x-app-layout>
