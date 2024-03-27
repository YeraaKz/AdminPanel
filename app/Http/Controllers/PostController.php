<?php

namespace App\Http\Controllers;

use App\Exports\PostsExport;
use App\Http\Utils\PostExport;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Utils\PostFilter;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return redirect()->route('admin.dashboard.posts.show', $post)->with('success', 'Post updated successfully');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('warehouse', 'LIKE', "%{$query}%")->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function filter(Request $request, PostFilter $postFilter)
    {
        $posts = $postFilter->apply($request)->paginate(10);

        return view('admin.posts.index', compact('posts'));
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

    public function export(PostExport $postExport)
    {
        return $postExport->export();
    }
}
