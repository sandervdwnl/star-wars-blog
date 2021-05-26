<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index() 
    {
        $posts = DB::table('posts')->where('featured', '=', 1)->get();
        return view('index', ['posts' => $posts]);
    }
}
