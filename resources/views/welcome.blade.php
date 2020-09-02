@extends('templates.layout')
@section('content')
    <h2>{{ __('messages.welcome') }}</h2>
    @can("home.secret")
    	<a href="{{ route('secret') }}">Click here to see special content.</a>
    @endcan
@endsection
