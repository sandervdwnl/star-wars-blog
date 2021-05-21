<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create A Post Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="container">
                        <div class="row">

                            <div class="col-md-8 offset-md-2">

                                {{-- Error output by store()-method 
                                messages come from resources/lang/en/validation.php --}}
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form method="POST" action="/posts/{{ $post->id }}">
                                    @method('put')
                                    @csrf
                                    <div class="form-group">
                                        <label for="Title">Title</label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" value="{{ $post->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Content</label>
                                        <textarea class="form-control" id="content" name="content" placeholder="Enter content">{{ $post->content }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Post</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
