@extends('layouts.app')

@section('title') edit comment @endsection

@section('sec')

<form method="POST" action="{{ route('comment.update',['post' => $post['id'] , 'comment' => $comment['id']]) }}">
    @csrf
    @method('PUT')
    <div class="my-3">
        <h5 class="form-label mt-5">update your Comment</h5>
        <input type="text" name="body" class="form-control" value="{{$comment->body}}">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
@endsection