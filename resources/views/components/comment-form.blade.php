<div class="mb-2 mt-2">
@auth
<x-errors></x-errors>
<form method="POST" action="{{ $route }}" class="form">
    @csrf
    <div class="form-group">
        <label class="" for="content">Content</label><br>
        <textarea class="form-control" rows="3" type="text" name="content">
        </textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Add comment</button>
</form>
@else
    <a href="{{ route('login') }}">Login</a> to post a comment.
@endauth
</div>
<hr>
