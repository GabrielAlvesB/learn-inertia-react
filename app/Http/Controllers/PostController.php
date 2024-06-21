<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return Inertia::render('Posts/Index',[
            'posts' => PostResource::collection($posts)
        ]);
    }

    public function store(StorePostRequest $request)
    {
        // dd($request->validated());
        auth()->user()->posts()->create(
            $request -> validated()
        ); 

        return redirect()->route('posts.index');
    }
}
