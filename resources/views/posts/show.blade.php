@extends('templates.layout')
@section('content')
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</p>

    <x-updated :date="$post->created_at"
        :name="$post->user->name">
    </x-updated>
    <x-updated :date="$post->updated_at">
        Updated
    </x-updated>

    <x-badge :show="now()->diffInMinutes($post->created_at) < 50 ?  'true' : ''" >
        New BlogPost!
    </x-badge>

    <p>
        <strong>Currently read by {{ $counter }} people.</strong>
    </p>

    <h4>Comments</h4>
    @forelse($post->comments as $comment)
    	<p>{{$comment->content}}</p>
    	<x-updated :date="$post->created_at">
        </x-updated>
    @empty
    	<p>No comments yet.</p>
    @endforelse
@endsection
