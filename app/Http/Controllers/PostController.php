<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

// For usage username etc
use Illuminate\Support\Facades\Auth;
// For DB queries
use Illuminate\Support\Facades\DB;
// Form validation class
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    protected $posts;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['idex', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Accesses Post table via Post Model,
        // selects all posts
        // and saves all posts in array
        $posts = Post::all();

        // Return views/posts/index with $posts array
        return view('posts.index')
        ->with('posts', $posts);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view posts/create to display create form
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:50',
            'featured_image' => 'mimetypes:image/jpeg|max:2560'
        ]);

        
        // Featured Image, move to public storage
        // Store gives file a random filename
        if($request->has('featured_image') ) {
            $img_path = $request->file('featured_image')->store('images', 'public');
        }
        else {
            $img_path = '';
        }

        // Featured 
        if($request->has('featured')) {
            $featured = 1;
        }
        else {
            $featured = 0;
        }


        // Store new Post object
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
            'featured_image' => $img_path,
            'featured' => $featured
        ]);
        // Save 
        $post->save();

        // return the index view by calling index() method
        return $this->index()->with(["message" => "Post "  . $post->title . " is created"]);

    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // select single post with id argument
        $post = Post::where('id', $id)->first();

        // return a single post view with array $post
        return view('posts.show')->with(['post' => $post]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // select post row from id
        $post = Post::where('id', $id)->first();

        // return a single post view with array $post
        return view('posts.edit')->with(['post' => $post]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate input
        $request->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:50'
        ]);

        // Update query
        Post::where('id', $id)
        ->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
            ]);

        // redirect
        return $this->index()->with(["message" => "Post is updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // select single post with id argument
        $post = Post::where('id', $id)->delete();

        // redirect with message
        return $this->index()->with(["message" => "Post is deleted"]);
    }
}
