<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Comment;

// For usage username etc
use Illuminate\Support\Facades\Auth;
// For DB queries
use Illuminate\Support\Facades\DB;
// Form validation class
use Illuminate\Support\Facades\Validator;
// Image Intervention 
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    protected $posts;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
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
            'featured_image' => 'mimetypes:image/jpeg|max:2000'
        ]);

        // Featured Image, move to public storage
        // Store gives file a random filename
        if($request->has('featured_image') ) {
            // Image Intervention
            $og_img = Image::make($request->featured_image);

            // Image name without extensions (1234567)
            $img_name = rand(1111,9999) * rand(1, 9);

            // Resize for XL quailty 85 in public/img/1234567_xl.jpg
            $img_xl = $og_img->resize(1200,800)->save( public_path('/img/' . $img_name . '_xl.jpg'), 85 );
            // Resize for MD quailty 85 in public/img/1234_xl.jpg
            $img_thumb = $og_img->resize(300,200)->save( public_path('/img/' . $img_name . '_thumb.jpg'), 85 );
        
        }
        else { // no image uploaded
            $img_name = '';
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
            'author' => auth()->user()->name,
            'featured_image' => 'img/' . $img_name,
            'featured' => $featured,
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

        // select comments from comments table
        $comment = Comment::where('post_id', $id)->get();

        // return a single post view with array $post
        return view('posts.show')->with(['post' => $post, 'comment' => $comment]); 
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
            'content' => 'required|min:50',
            'featured_image' => 'mimetypes:image/jpeg|max:2000',
        ]);

           // Featured Image, move to public storage
        // Store gives file a random filename
        if($request->has('featured_image') ) {

            // Image Intervention
            $og_img = Image::make($request->featured_image);

            // Image name without extensions (1234567)
            $img_name = rand(1111,9999) * rand(1, 9);

            // Resize for XL quailty 85 in public/img/1234567_xl.jpg
            $img_xl = $og_img->resize(1200,800)->save( public_path('/img/' . $img_name . '_xl.jpg'), 85 );
            // Resize for MD quailty 85 in public/img/1234_xl.jpg
            $img_thumb = $og_img->resize(300,200)->save( public_path('/img/' . $img_name . '_thumb.jpg'), 85 );
            
        }
        else { // no image uploaded
            $img_name = '';
        }

        // Featured 
        if($request->has('featured')) {
            $featured = 1;
        }
        else {
            $featured = 0;
        }

        // Update query
        Post::where('id', $id)
        ->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'featured_image' => 'img/' . $img_name,
            'featured' => $featured,
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
