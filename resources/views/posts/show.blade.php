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
        <h5 class="card-title">Comments : </h5>
        @foreach ($postShow->comments as $comment)
        <p class="card-text">{{ $comment->body }}</p>
        @endforeach

    </div>
</div>


@endsection