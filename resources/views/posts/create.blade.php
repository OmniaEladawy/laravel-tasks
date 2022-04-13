@extends('layouts.app')

@section('title') create @endsection

@section('sec')

<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="my-5">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="mb-5">
        <label class="form-label d-block">Description</label>
        <textarea rows="5" name="des" class="w-100 form-control"></textarea>
    </div>
    <div class="mb-5">
        <label class="form-label d-block">Post Creator</label>
        <select class="w-100 form-control" name="creator">
            @foreach ($creators as $creator){
            <option value="{{$creator->id}}"> {{$creator->name}} </option>
            @endforeach

        </select>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>
@endsection