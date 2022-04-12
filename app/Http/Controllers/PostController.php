<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;

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
        // dd($postShow);

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

    public function update($id)
    {
        $updatedPost = Post::find($id);
        $data = request()->post();
        $updatedPost->title = $data['title'];
        $updatedPost->description = $data['des'];
        $updatedPost->user_id = $data['creator'];
        $updatedPost->save();
        return to_route('posts.index'); //redirect to index function
    }

    public function delete($id)
    {

        $user = Post::find($id);
        $user->delete();
        return to_route('posts.index'); //redirect to index function
    }
}
