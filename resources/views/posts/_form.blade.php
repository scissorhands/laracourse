@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<p>
    <label for="title">Title</label><br>
    <input type="text" name="title" value="{{ old('title', $post->title ?? null) }}">
</p>
<p>
    <label for="content">Content</label><br>
    <textarea name="content" id="content" cols="30" rows="10">{{ old('content', $post->content ?? null) }}</textarea>
</p>
<p>
    <button type="submit" class="btn btn-primary">Send</button>
</p>
