@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($posts as $post)
        <div class="row mb-2 justify-content-md-center">
            <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                <a href="{{ route('web.authors.show', ['author_id' => $post->user->id]) }}" class="d-inline-block mb-2 text-success">{{ $post->user->name }}</a>
                <h3 class="mb-0">{{$post->title}}</h3>
                <div class="mb-1 text-muted">{{ $post->created_at->diffForHumans() }}</div>
                <p class="card-text mb-auto">{{ $post->text }}</p>
                <a href="{{ route('web.posts.show', ['post_id' => $post->id]) }}" class="d-inline-block mb-2 text-primary">Continue reading</a>
                </div>
            </div>
            </div>
        </div>
    @endforeach
    {{ $posts->render() }}
</div>
@endsection
