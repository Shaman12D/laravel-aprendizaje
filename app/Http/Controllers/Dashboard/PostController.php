<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PutRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return redirect("/post/create");
        //$posts = Post::get();
        //return redirect()->route('post.create');
        //return to_route("post.create");

        $posts = Post::paginate(10);
        if(!Gate::allows('index', $posts[0])){
            abort(403);
        }
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::pluck('id','title');
        $post=new Post();
        if(!Gate::allows('create', $post)){
            abort(403);
        }
        //dd($categories);
        echo view('dashboard.post.create',compact('categories', 'post'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // echo request("title");

        // echo $request->input('slug');

        // $validated = $request->validate([
        //     "title"=>"required|min:5|max:500",
        //     "slug"=>"required|min:5|max:500",
        //     "content"=>"required|min:7",
        //     "category_id"=>"required|integer",
        //     "description"=>"required|min:7",
        //     "posted"=>"required"
        // ]);

        //$validated = $request->validate(StoreRequest::myRules());

        //dd($validated);

        //$validated=Validator::make($request->all(),StoreRequest::myRules()); // Posiblemete se use este tipo de validación
        // dd($validated->errors());
        //dd($validated->fails());

        //$data = array_merge($request->all(),['image'=>'']);

        //dd($data);
        //dd($request->validate());

        // $data=$request->validated();
        // $data['slug']=Str::slug($data['title']);
        // dd($data);
        $post = new Post($request->validated());

        if(!Gate::allows('create', $post)){
            abort(403);
        }
        Auth::user()->posts()->save($post);
        return to_route("post.index")->with('status',"Registro creado.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //TESTING
        // if (Gate::any(['update','view'], $post)) {
        //     dd(true);
        // }

        // if (Gate::none(['update','view'], $post)) {
        //     dd(true);
        // }

        // if (Auth::user()->can('update', $post)) {
        //     dd(true);
        // }

        // if (Gate::forUser(User::find(2))->allows('update', $post)){
        //     dd(true);
        // }

        // Gate::allowIf(function(User $user) {
        //     return !$user->isAdmin();
        // });

        // Gate::allowIf(
        //     fn (User $user) =>
        //     $user->isAdmin()
        // );

        // Gate::denyIf(
        //     fn (User $user) =>
        //     !$user->isAdmin()
        // );

        // if (Auth::user()->isAdmin()){
        //     abort(403);
        // }

        Gate::authorize('index', $post);

        //END TESTING

        // if(!Gate::allows('view', $post)){
        //     abort(403);
        // }
        return view("dashboard.post.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // if(!Gate::allows('update-post',$post)){
        //     return abort(403);
        // }

        if(!Gate::allows('update',$post)){
            return abort(403);
        }

        $categories=Category::pluck('id','title');
        $status = "Ok lo editaste";
        return view('dashboard.post.edit',compact('categories', 'post'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        // if(!Gate::allows('update-post',$post)){
        //     return abort(403);
        // }

        if(!Gate::allows('update',$post)){
            return abort(403);
        }

        $data = $request->validated();
        if(isset($data["image"])){
            $data["image"] = $filename = time().".".$data["image"]->getClientOriginalName();
            $request->image->move(public_path("image"), $filename);
        }

        $post->update($data);
        //$request->session()->flash('status',"Registro actualizado.");
        return to_route("post.index")->with('status',"Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(!Gate::allows('delete',$post)){
            return abort(403);
        }
        $post->delete();
        return to_route("post.index")->with('status',"Registro eliminado.");
    }
}
