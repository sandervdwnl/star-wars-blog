<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <h2>Comments</h2>

                    @if (isset($message))
                    <p class="bg-info mt-2 text-center p-2">
                        <b>{{ $message }}</b>
                    </p>
                    @endif

                    <div class="container">

                        <div class="flex mb-2 border-b-2">
                            <div class="w-2/12 font-bold">Title</div>
                            <div class="w-2/12 font-bold">Author</div>
                            <div class="w-1/12 font-bold">Post ID</div>
                            <div class="w-1/12 font-bold">Approved</div>
                            <div class="w-2/12 font-bold">Created at</div>
                            <div class="w-2/12 font-bold">Approve Comment</a></div>
                            <div class="w-2/12 font-bold">Delete Comment</div>
                        </div>

                        @foreach ($comments as $comment)
                        <div class="flex mb-2 border-b-2 pb-2">
                            <div class="w-2/12">{{ $comment->comment }}</div>
                            <div class="w-2/12">{{ $comment->author }}</div>
                            <div class="w-1/12">{{ $comment->post_id }}</div>
                            <div class="w-1/12">{{ $comment->approved }}</div>
                            <div class="w-2/12">{{ $comment->created_at }}</div>
                            <div class="w-2/12">
                                @if ($comment->approved)
                                <span class="text-gray-400">&#x2714;Approved</span>
                                @else
                                <form method="POST" action="/comments/{{ $comment->id }}">
                                    @method('put')
                                    @csrf
                                    <input type="hidden" name="approved" value="1">
                                    <input type="submit" value="&#x271A; Approve" class="text-green-400 bg-white font-bold">
                                </form>
                                @endif
                            </div>
                            <div class="w-2/12">
                                <form method="POST" action="/comments/{{ $comment->id }}">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" value="Delete" class="text-red-500 bg-white font-bold">
                                </form>
                            </div>
                        </div>
                        @endforeach

                        <div class="w-full text-center">{{ $comments->links() }}</div>
                    </div>


                </div>



            </div>
        </div>
    </div>
    </div>
</x-guest-layout>
