<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $post_user = Post::with('user')->get();



        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $postShow = Post::find($id);
        return new PostResource($postShow);
    }

    public function store()
    {
        request()->validate([
            'title' => "required|unique:posts|min:3",
            'des' => ['required', 'min:10'],
            'creator' => 'required|exists:users,id'
        ]);


        $data = request()->post();


        if (request()->hasFile('image')) {
            $destination_path = 'public/images';
            $image = request()->file('image');
            $image_name = $image->getClientOriginalName();
            $path = request()->file('image')->storeAs($destination_path, $image_name);
            $data['image'] = $image_name;
        }

        Post::create([
            'title' => $data['title'],
            'description' => $data['des'],
            'user_id' => $data['creator'],
            'image' => $data['image']
        ]);

        return $data;
    }
}
