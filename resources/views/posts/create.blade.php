@extends('templates.app')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('posts.store') }}">
       @csrf
        <p>
            <label for="title">Title</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
        </p>
        <p>
            <label for="content">Content</label><br>
            <textarea name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
        </p>
        <p>
            <button type="submit" class="btn btn-primary">Send</button>
        </p>
    </form>
@endsection
