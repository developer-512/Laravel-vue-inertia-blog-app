<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\RedirectResponse;
use inertia\Response;

class PostController extends Controller
{

    public function index(): Response
    {
        $posts = Post::with('categories')->get();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }
    public function create(): Response
    {
        $categories = PostCategory::with(['parentCategory'])->get();
        return Inertia::render('Posts/Create', ['categories' => $categories]);
    }
    public function edit(Post $post): Response
    {
        $post->load('categories');
        $categories = PostCategory::with(['parentCategory'])->get();
        return Inertia::render('Posts/Create', ['post' => $post, 'isUpdating' => true, 'categories' => $categories]);
    }
    public function store(Request $request): RedirectResponse
    {
        $post = new Post($request->all());
        $post->save();
        $post->categories()->sync($request->categories??[]);
        return redirect()->route('posts.index');
    }
    public function update(Request $request, Post $post): RedirectResponse
    {
//        dd($request->all());
        $post->update($request->all());
        $post->categories()->sync($request->categories??[]);
        return redirect()->route('posts.index');
    }
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->back();
    }
}
