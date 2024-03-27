<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $posts = Post::paginate(10);
        return view('admin/dashboard', compact('posts'));
    }
}
