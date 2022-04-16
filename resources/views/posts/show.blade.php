@extends('layouts.app')

@section('title') show @endsection

@section('sec')


<div class="card my-5">
    <div class="card-header"> Post info </div>
    <div class="card-body">
        <img src="{{asset('/storage/images/'.$postShow->image)}}" />
        <h5 class="card-title">Title : </h5>
        <p class="card-text">{{$postShow->title}}</p>
        <h5 class="card-title">Description</h5>
        <p class="card-text">{{$postShow->description}}</p>
    </div>
</div>

<div class="card">
    <div class="card-header"> Post creator info </div>
    <div class="card-body">
        <h5 class="card-title">Name : </h5>
        <p class="card-text">{{$postShow->user->name}}</p>
        <h5 class="card-title">Created at : </h5>
        <p class="card-text">{{$postShow->created_at->format('l jS \\of F Y h:i:s A')}}</p>

        <form method="POST" action="{{ route('comments.create',['post' => $postShow['id']]) }}">
            @csrf
            <div class="my-3">
                <h5 class="form-label mt-5">Write your Comment</h5>
                <input type="text" name="body" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Add Comment</button>
        </form>

        <h5 class="card-title mt-5">All Comments : </h5>
        @foreach ($postShow->comments as $comment)
        <p class="card-text">{{ $comment->body }}</p>
        <form action="{{ route('comments.delete',['post' => $postShow['id'] , 'comment' => $comment['id']]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button onClick="if(!confirm('Are you sure ?')){return false;}" type="submit" class="btn btn-danger mr-3 mb-5">Delete</button>
        </form>
        <a href="{{ route('comments.edit',['post' => $postShow['id'] , 'comment' => $comment['id']]) }}" type="button" class="btn btn-primary mr-2" style="margin-top: -45px; padding: 6px 19px;">Edit</a>
        @endforeach

    </div>
</div>


@endsection