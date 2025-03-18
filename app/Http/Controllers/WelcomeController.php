<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->get();

        return view('welcome2', compact('posts'));
    }

    public function about()
    {
        return view('about');
    }
}
