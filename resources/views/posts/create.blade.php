@extends('templates.layout')
@section('content')
    <x-errors></x-errors>
    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
       @csrf
       @include('posts._form')
    </form>
@endsection
