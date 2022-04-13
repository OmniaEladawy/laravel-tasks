@extends('layouts.app')

@section('title') index @endsection

@section('sec')

<div class="text-center">
    <a href="{{ route('posts.create') }}" type="button" class="btn btn-success my-4">Create Post</a>
</div>
<table class="table">
    <thead class="text-center">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($allPosts as $post){
        <tr>
            <th>{{$post['id']}}</th>
            <td>{{$post['title']}}</td>
            <td>{{$post->user->name}}</td>
            <td>{{$post['created_at']->format('Y-m-d')}}</td>
            <td>
                <a href="{{ route('posts.show',['post' => $post['id']]) }}" type="button" class="btn btn-info mr-2">View</a>
                <a href="{{ route('posts.edit',['post' => $post['id']]) }}" type="button" class="btn btn-primary mr-2">Edit</a>
                <form action="{{ route('posts.delete',['post' => $post['id']]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button onClick="if(!confirm('Is the form filled out correctly?')){return false;}" type="submit" class="btn btn-danger mr-2">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $allPosts->links() }}

@endsection