<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{

    public function index()
    {

        //$allposts = Post::all();
        $posts = Post::paginate(10);

        return view('posts.index', [
            'allPosts' => $posts
        ]);
    }

    public function create()
    {
        $creators = User::all();
        return view('posts.create', [
            'creators' => $creators
        ]);
    }

    public function store()
    {
        request()->validate([
            'title' => "required|unique:posts|min:3",
            'des' => ['required', 'min:10'],
            'creator' => 'required|exists:users,id'
        ]);

        $data = request()->post();


        Post::create([
            'title' => $data['title'],
            'description' => $data['des'],
            'user_id' => $data['creator']
        ]);

        return to_route('posts.index'); //redirect to index function
    }

    public function show($id)
    {
        $postShow = Post::find($id);
        return view('posts.show', [
            "postShow" => $postShow
        ]);
    }

    public function edit($id)
    {
        $postShow = Post::find($id);
        $creators = User::all();
        return view('posts.update', [
            "postShow" => $postShow,
            "creators" => $creators
        ]);
    }

    public function update(StorePostRequest $request, Post $post)
    {
        //dd($post);
        //$updatedPost = Post::find($post);
        $data = request()->post();
        $post->title = $data['title'];
        $post->description = $data['des'];
        $post->user_id = $data['creator'];
        $post->save();
        return to_route('posts.index'); //redirect to index function
    }

    public function delete($id)
    {

        $user = Post::find($id);
        $user->delete();
        return to_route('posts.index'); //redirect to index function
    }
}
