@extends('templates.app')
@section('content')
    <form method="POST" action="{{ route('posts.update', ['post'=>$post->id]) }}">
       @csrf
       @method('PUT')
       @include('posts._form')
    </form>
@endsection
