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
                <td>
                    <a href="{{ route('posts.edit', ['post'=>$post->id]) }}">Edit</a>
                    <form method="POST"
                        action="{{ route('posts.destroy', ['post'=>$post->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn" type="submit">Delete</button>
                    </form>
            </tr>
            @empty
                <tr>No posts</tr>
            @endforelse
        </tbody>
    </table>
@endsection
