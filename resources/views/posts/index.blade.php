@extends('templates.layout')
@section('content')
    <div class="row">
            @forelse ($posts as $post)
                <div class="col-sm-12" style="padding-top: 28px">
                    <h3><a href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a></h3>
                    @if($post->comments_count)
                        <p>{{ $post->comments_count }} comments</p>
                    @else
                        <p>No comments</p>
                    @endif
                    <a class="btn btn-secondary btn-sm" href="{{ route('posts.edit', ['post'=>$post->id]) }}">Edit</a>
                    <form method="POST" class="form" style="display: inline"
                        action="{{ route('posts.destroy', ['post'=>$post->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </div>
            @empty
                <p>No posts</p>
            @endforelse
    </div>
@endsection
