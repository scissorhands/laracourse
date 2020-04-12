@extends('templates.layout')
@section('content')
    <h3>{{ $post->title }}</h3>
    <p>{{ $post->content }}</p>
    <i>{{ $post->created_at->diffForHumans() }}</i>
@endsection
