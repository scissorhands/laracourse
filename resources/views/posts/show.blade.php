@extends('templates.layout')
@section('content')
<div class="row">
    <div class="col-8">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->content }}</p>
        @if($post->image)
            <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
                <h1 style="padding-top: 100px; text-shadow: 1px 2px #000"></h1>
            </div>
        @else
            <h1></h1>
        @endif

        <x-updated :date="$post->created_at"
            :name="$post->user->name">
        </x-updated>
        <x-updated :date="$post->updated_at">
            Updated
        </x-updated>
        <x-tags :tags="$post->tags"></x-tags>

        <x-badge :show="now()->diffInMinutes($post->created_at) < 50 ?  'true' : ''" >
            New BlogPost!
        </x-badge>

        <p>
            <strong>Currently read by {{ $counter }} people.</strong>
        </p>

        <h4>Comments</h4>
        @include('comments._form')
        @forelse($post->comments as $comment)
            <p>{{$comment->content}}</p>
            <x-updated
                :date="$comment->created_at"
                :name="$comment->user->name">
            </x-updated>
        @empty
            <p>No comments yet.</p>
        @endforelse
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>
@endsection
