<?php

namespace App\Http\Controllers;

use App\Models\PostCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;

class PostCategoryController extends Controller
{
    public function index(): Response
    {
        $categories = PostCategory::with(['parentCategory'])->get();
        return Inertia::render('postCategories/Index', ['categories' => $categories]);
    }
    public function create(): Response
    {
        $categories = PostCategory::with(['parentCategory'])->get();//->pluck('category_name', 'id')->toArray();
        return Inertia::render('postCategories/Create',['categories' => $categories]);
    }
    public function store(Request $request): RedirectResponse
    {
//        dd($request->all());
        $postCategory = new PostCategory($request->all());
        $postCategory->save();
        return redirect()->route('categories.index');
    }
    public function edit(PostCategory $category): Response
    {
        $categories = PostCategory::with(['parentCategory'])->whereNot('id',$category->id)->get();
        $category->load('parentCategory');
        return Inertia::render('postCategories/Create',['category'=>$category,'categories' => $categories,'isUpdating'=>true]);
    }

    public function update(Request $request,PostCategory $category): RedirectResponse
    {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }
}
