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

    public function store(Request $request)
    {

        $input = request()->post();
        dd($input);

        //     $post = new Post();

        // $ASNumber = $request->input('ASNumber');
        // $choice=$request->input('choice');
        // $peeringDB=$request->input('peeringDB');
        // $ASSET =$request->input('AS-SET');
        // $Contact=$request->input('Contact');  

        // $data = array(
        //     'asnumber' => $ASNumber,
        //     'peeringrs' => $choice,
        //     'peeringdb' => $peeringDB,
        //     'AS-SET' => $ASSET,
        //     'contact' => $Contact
        // );

        // $post->save();
        // return redirect('/');

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
        return view('posts.update');
    }
}
