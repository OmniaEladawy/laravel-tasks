<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $allPosts;

    public function __construct()
    {
        $this->allPosts = [
            ['id' => 1, 'title' => 'first post', 'createdBy' => 'Omnia', 'createdAt' => '2022-04-10'],
            ['id' => 2, 'title' => 'second post', 'createdBy' => 'Ahmed', 'createdAt' => '2022-03-18']
        ];
    }

    public function index()
    {
        // $allPosts = [
        //     ['id' => 1, 'title' => 'first post', 'createdBy' => 'Omnia', 'createdAt' => '2022-04-10'],
        //     ['id' => 2, 'title' => 'second post', 'createdBy' => 'Ahmed', 'createdAt' => '2022-03-18']
        // ];

        // dd($allPosts); //stop exe and dump the variable

        return view('posts.index', [
            'allPosts' => $this->allPosts
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {

        $input = request()->all();
        $post = [
            "id" => count($this->allPosts) + 1,
            "title" => request()['title'],
            "createdBy" => request()['creator'],
            "createdAt" => request()['createdAt'],
        ];

        array_push($this->allPosts, $post);

        return view('posts.index', ['allPosts' => $this->allPosts]);
    }

    public function show($id)
    {
        $id = (int)$id;
        $filteredPost = array_filter($this->allPosts, function ($post) use ($id) {
            return $post["id"] === $id;
        });

        return view('posts.show', [
            "filteredPost" => $filteredPost
        ]);
    }

    public function edit($id)
    {
        $id = (int)$id;
        $filteredPost = array_filter($this->allPosts, function ($post) use ($id) {
            return $post["id"] === $id;
        });

        return view('posts.update', [
            "filteredPost" => $filteredPost
        ]);
    }

    public function delete($id)
    {
        return "deleted";
    }

    public function update($id)
    {
        return "updated";
    }
}
