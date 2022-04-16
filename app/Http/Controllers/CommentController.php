<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function store($id)
    {

        $postShow = Post::find($id);

        $postShow->comments()->create([
            'body' => request()->body
        ]);

        return to_route('posts.show', ['post' => $postShow['id']]); //redirect to index function
    }

    public function edit($post, $id)
    {
        $postShow = Post::find($post);
        $comment = Comment::find($id);
        return view('posts.comment', [
            "comment" => $comment,
            "post" => $postShow
        ]);
    }

    public function update($post, $id)
    {

        $data = request()->post();
        $comment = Comment::find($id);
        $postShow = Post::find($post);

        $comment->body = $data['body'];
        $comment->save();
        return to_route('posts.show', ['post' => $postShow['id']]); //redirect to index function
    }

    public function delete($post, $id)
    {

        $postShow = Post::find($post);
        $comment = Comment::find($id);
        $comment->delete();
        return to_route('posts.show', ['post' => $postShow['id']]); //redirect to index function
    }
}
