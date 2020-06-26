@extends('templates.layout')
@section('content')
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</p>
    <i>Added {{ $post->created_at->diffForHumans() }}</i>

    <x-badge :show="now()->diffInMinutes($post->created_at) < 50 ?  'true' : ''" >
        New BlogPost!
    </x-badge>

    <h4>Comments</h4>
    @forelse($post->comments as $comment)
    	<p>{{$comment->content}}</p>
    	<p class="text-muted">added {{ $comment->created_at->diffForHumans() }}</p>
    @empty
    	<p>No comments yet.</p>
    @endforelse
@endsection
