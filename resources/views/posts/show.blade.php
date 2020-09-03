@extends('templates.layout')
@section('content')
<div class="row">
    <div class="col-8">
        @if($post->image)
            <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
                <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">{{ $post->title }}</h1>
            </div>
        @else
            <h1>{{ $post->title }}</h1>
        @endif

        <p>{{ $post->content }}</p>

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
            <strong>{{ trans_choice('messages.people.reading', ['count'=>$counter]) }}</strong>
        </p>

        <h4>Comments</h4>
        <x-comment-form :route="route('posts.comments.store', ['post'=>$post->id])"></x-comment-form>
        <x-comment-list :comments="$post->comments"></x-comment-list>
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>
@endsection
