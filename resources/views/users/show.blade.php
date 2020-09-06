@extends('templates.layout')
@section('content')

    <div class="row">
        <div class='col-4'>
            <img src="{{ $user->image ? $user->image->url() : '' }}" alt="img" class="img-thumbnail avatar">
        </div>
        <div class='col-8'>
            <h3>{{ $user->name }}</h3>

            <p>Currently viewd by {{ $counter }} users</p>

            <x-comment-form :route="route('users.comments.store', ['user'=>$user->id])"></x-comment-form>
            <x-comment-list :comments="$user->commentsOn"></x-comment-list>
        </div>
    </div>
@endsection
