<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Post::with('category')->paginate(5));
    }

    public function all(){
        return response()->json(Post::get());
    }

    public function slug(Post $post) //$slug
    {
        //$post = Post::with("category")->where("slug", $slug)->firstOrFail();
        $post->category; //manda la información de la categoria por medio del id
        return response()->json($post);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        return response()->json(Post::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        $post = $post->update($request->validated());
        return response()->json($post);
    }

    public function upload(Request $request, Post $post)
    {
        $data["image"] = $filename = time().".".$request["image"]->getClientOriginalName();
        $request->image->move(public_path("image/vue"), $filename);

        $post->update($data);
        return response()->json($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json("ok");
    }
}
