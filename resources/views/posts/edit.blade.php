@extends('templates.layout')
@section('content')
    <x-errors></x-errors>
    <form method="POST" action="{{ route('posts.update', ['post'=>$post->id]) }}" enctype="multipart/form-data">
       @csrf
       @method('PUT')
       @include('posts._form')
    </form>
@endsection
