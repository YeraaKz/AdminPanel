<?php

namespace App\Http\Controllers;

use App\Exports\PostsExport;
use App\Models\Post;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('warehouse', 'LIKE', "%{$query}%")->paginate(10);

        return view('admin.dashboard', compact('posts'));
    }

    public function filter(Request $request)
    {
        $query = Post::query();

        $query->when($request->filled('status'), function ($q) use ($request){
            return $q->where('status', $request->status);
        });

        $query->when($request->filled('quantity_min'), function ($q) use ($request) {
            return $q->where('quantity', '>=', $request->quantity_min);
        });

        $query->when($request->filled('quantity_max'), function ($q) use ($request) {
            return $q->where('quantity', '<=', $request->quantity_max);
        });

        $posts = $query->paginate(10);

        return view('admin.dashboard', compact('posts'));
    }

    public function process(Request $request)
    {
        $selectedPosts = $request->input('selected_posts', []);

        if (!empty($selectedPosts)) {
            Post::whereIn('id', $selectedPosts)->update(['status' => 'Processed']);
            return back()->with('success', 'Selected post was processed successfully');
        }

        return back()->with('error', 'You should pick at least one post');
    }

    public function close(Request $request)
    {

        $postId = $request->input('post_id');

        $post = Post::findOrFail($postId);

        $post->status = 'Closed';

        $post->save();

        return back()->with('success', 'Post status changed to "processed".');
    }

    public function export()
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
}
