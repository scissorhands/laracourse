@extends('templates.layout')
@section('content')
    <a class="btn btn-primary" href="{{ route('posts.create') }}">Create new post</a>
    <br><br>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td><a href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a></td>
                <td>
                    <a class="btn btn-secondary btn-sm" href="{{ route('posts.edit', ['post'=>$post->id]) }}">Edit</a>
                </td>
                <td>
                    <form method="POST"
                        action="{{ route('posts.destroy', ['post'=>$post->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td>No posts</td>
                <td></td>
                <td></td>
            </tr>
            @endforelse
        </tbody>
    </table>
@endsection
