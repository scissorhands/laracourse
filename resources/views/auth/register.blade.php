@extends("templates.layout")
@section("content")
<form method="POST" action="{{ route('register') }}">
	@csrf
	<div class="form-group">
	    <label for="name">Name</label>
	    <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required type="input" name="name" value="{{ old('name') }}">
	    @if($errors->has('name'))
	    	<span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
	    @endif
	</div>

	<div class="form-group">
	    <label for="email">Email</label>
	    <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required type="input" name="email" value="{{ old('email') }}">
	    @if($errors->has('email'))
	    	<span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
	    @endif
	</div>

	<div class="form-group">
	    <label for="password">Password</label>
	    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required type="password" name="password" value="{{ old('password') }}">
	    @if($errors->has('password'))
	    	<span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
	    @endif
	</div>

	<div class="form-group">
	    <label for="password_confirmation">Password confirmation</label>
	    <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" required type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
	    @if($errors->has('password_confirmation'))
	    	<span class="invalid-feedback"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
	    @endif
	</div>

	<button type="submit" class="btn btn-primary btn-block">Register</button>
</form>
@endsection
