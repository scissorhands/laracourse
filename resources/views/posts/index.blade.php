@extends('templates.app')
@section('content')
    <a class="btn btn-primary" href="{{ route('posts.create') }}">Create new post</a>
    <ul>
     @forelse($posts as $post)
        <li>
            <a href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a>
        </li>
    @empty
        <p>No posts</p>
    @endforelse
    </ul>
@endsection
