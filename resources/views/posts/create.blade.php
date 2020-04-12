@extends('templates.layout')
@section('content')
    <form method="POST" action="{{ route('posts.store') }}">
       @csrf
       @include('posts._form')
    </form>
@endsection
