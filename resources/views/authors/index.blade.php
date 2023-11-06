@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2 justify-content-md-center">
        <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
            <a class="d-inline-block mb-2 text-success">{{ $author->name }}</a>
            <h3 class="mb-0">{{$author->email}}</h3>
            <a href="{{ route('web.dashboard') }}" class="d-inline-block mb-2 text-primary">Back</a>
            </div>
        </div>
        </div>
    </div>

    <div class="row">
        @foreach($author->comments as $comment)
        <div class="col-md-12 mb-4">
            <div class="card">
            <div class="card-header">
                {{ $comment->created_at->diffForHumans() }} - <a href="{{ route('web.posts.show', ['post_id' => $comment->post->id]) }}" class="d-inline-block mb-2 text-primary">Show Post</a>
            </div>
            <div class="card-body">
                {{ $comment->text }}
            </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
