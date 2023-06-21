<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\PutRequest;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::paginate(10));
    }

    public function all(){
        return response()->json(Category::get());
    }

    public function slug($slug) {
        $category = Category::where("slug", $slug)->firstOrFail();
        return response()->json($category);
    }

    public function create()
    {
        //
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Category::create($request->validated()));
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        //
    }

    public function update(PutRequest $request, Category $category)
    {
        $category->update($request->validated());
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json("ok");
    }

    public function posts(Category $category){
        // Eloquent
        // $posts = Post::join('categories', "categories.id", "=", "posts.category_id")
        // ->select("posts.*", "categories.title as category")
        // ->where("categories.id", $category->id)
        // ->get();
        // End Eloquent

        // Query Builder
        $posts = Post::with("category")
        ->where("category_id", $category->id)
        ->get();
        //ToSql

        return response()->json($posts);
        // End Builder
    }
}
