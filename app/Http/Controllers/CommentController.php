<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;
use App\Models\Post;

use Illuminate\Routing\Redirector;

// For DB queries
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{

    protected $comments;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Accesses Post table via Post Model,
        // selects all posts
        // and saves all posts in array
        // $comments = DB::table('comments')->orderByDesc('created_at')->get();

        // Return views/posts/index with $posts array
        // return view('comments.index')
        // ->with('comments', $comments);    
        
        return view('comments.index', [
            'comments' => Comment::paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'author' => 'required|min:3',
            'comment' => 'required|min:3',
            'post_id' => 'required|min:1|max:2'
        ]);
        
            $post_id = $request->input('post_id');
       
        // new Comment object
        $comment = new Comment([
            'author' => $request->input('author'),
            'comment' => $request->input('comment'),
            'post_id'=> $post_id,
            'approved' => 0,
        ]);
        // Save 
        $comment->save();

        $post = Post::where('id', $post_id)->first();   

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $approved = $request->input('approved');

        $comment = Comment::find($id);

        $comment->approved = 1;

        $comment->save();

        return back();
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
        $comment = Comment::where('id', $id)->delete();

        // redirect with message
        return back();
    }
}
