@extends('templates.app')
@section('content')
    <a class="btn btn-primary" href="{{ route('posts.create') }}">Create new post</a>
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a></td>
                <td><a href="{{ route('posts.edit', ['post'=>$post->id]) }}">Edit</a>|<a href="#">Delete</a></td>
            </tr>
            @empty
                <tr>No posts</tr>
            @endforelse
        </tbody>
    </table>
@endsection
