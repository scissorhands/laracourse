@extends("templates.layout")
@section("content")
<form method="POST" action="{{ route('login') }}">
	@csrf
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

		<div class="form-check">
			<input class="form-check-input" type="checkbox" name="remember" value="{{ old('remember')? 'checked' : '' }}">
			<label class="form-check-label" for="remember">Remember me</label>
		</div>
	</div>
	<button type="submit" class="btn btn-primary btn-block">Login</button>
</form>
@endsection
