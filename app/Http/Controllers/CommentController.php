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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'post_id'=> $post_id
        ]);
        // Save 
        $comment->save();

        $post = Post::where('id', $post_id)->first();

        // return view('posts.show')
        // ->with([
        //     'comment' => $comment,
        //     'post' => $post
        // ]);      

        return back();

        // return redirect('/posts/{{post_id}}')->with([
        //     'comment' => $comment,
        //     'post' => $post
        // ]);
        

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
