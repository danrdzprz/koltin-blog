@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-md-8 ml-md-auto">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0">{{$post->title}}</h3>
                <div class="mb-1 text-muted">{{ $post->created_at->diffForHumans() }}</div>
                <p class="card-text mb-auto">{{ $post->text }}</p>
                <a href="{{ route( 'web.dashboard' )  }}" class="d-inline-block mb-2 text-primary">back</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 ml-md-auto">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">
                <a href="{{ route('web.authors.show', ['author_id' => $post->user->id]) }}" class="d-inline-block mb-2 text-success">{{ $post->user->name }}</a>
                <h3 class="mb-0">{{$post->user->email}}</h3>
                </div>
            </div>
            </div>
    </div>

    <div class="row">
        @foreach($post->comments as $comment)
        <div class="col-md-12 mb-4">
            <div class="card">
            <div class="card-header">
                <a href="{{ route('web.authors.show', ['author_id' => $post->user->id]) }}" class="d-inline-block mb-2 text-success"> {{ $comment->user->name }} - {{ $comment->created_at->diffForHumans() }}</a>
            </div>
            <div class="card-body">
                {!! $comment->text !!}
            </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
