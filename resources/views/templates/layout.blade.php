<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>My Bloggitty Blog</title>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><a style="text-decoration: none !important; color: #000;" href="{{ route('welcome') }}">My Bloggitty Blog</a></h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('home') }}">{{ __("Home") }}</a>
            <a class="p-2 text-dark" href="{{ route('posts.index') }}">{{ __('Blog Posts') }}</a>
            <a class="p-2 text-dark" href="{{ route('posts.create') }}">{{ __('Add') }}</a>
        </nav>
        @guest
            <a class="p-2 text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
            <a class="p-2 text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
        @else
            <a class="p-2 text-dark" href="{{ route('users.show', ['user'=> Auth::user()->id]) }}">
                {{ __('Profile') }}
            </a>
            <a class="p-2 text-dark" href="{{ route('users.edit', ['user'=> Auth::user()->id]) }}">
                {{ __('Edit Profile') }}
            </a>
            <a class="p-2 text-dark" onclick="event.preventDefault();document.getElementById('form-logout').submit();" href="#">{{ __('Logout') }} ({{ Auth::user()->name }})</a>
            <form method="POST" id="form-logout" action="{{ route('logout') }}" style="display: none">
                @csrf

            </form>
        @endguest
    </div>
    <div class="container">
        @if (session()->has('status'))
            <div class="alert alert-success">{{ session()->get('status') }}</div>
        @endif
        @yield('content')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
