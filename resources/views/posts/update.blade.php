@extends('layouts.app')

@section('title') edit @endsection

@section('sec')


<form action="{{ route('posts.update',['post' => $postShow['id']]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="my-5">
        <label class="form-label">Title</label>
        <input type="text" class="form-control" name="title" value="{{$postShow->title}}">
    </div>
    <div class="mb-5">
        <label class="form-label d-block">Description</label>
        <textarea rows="5" name="des" class="w-100 form-control">{{$postShow->description}}</textarea>
    </div>
    <div class="mb-5">
        <label class="form-label d-block">Post Creator</label>
        <select class="w-100 form-control" name="creator">
            @foreach ($creators as $creator){
            <option value="{{$creator->id}}"> {{$creator->name}} </option>
            @endforeach

        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>


@endsection