<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);

        return view('frontend.index', compact('posts'));
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $posts = Post::where('title', 'like', '%' .$search. '%')->paginate(6);
        return view('frontend.index', ['posts' => $posts]);
    }
    public function post(Post $post)
    {
        $post = $post->load(['comments.user', 'tags', 'user', 'category']);

        return view('frontend.post', compact('post'));
    }

    public function comment(Request $request, Post $post)
    {
        $this->validate($request, ['body' => 'required']);

        $post->comments()->create([
            'body' => $request->body
        ]);
        flash()->overlay('Comentário efetuado com sucesso');

        return redirect("/posts/{$post->id}");
    }
}
