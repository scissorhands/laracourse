<div class="form-group">
    <label class="" for="title">Title</label><br>
    <input class="form-control" type="text" name="title" value="{{ old('title', $post->title ?? null) }}">
</div>
<div class="form-group">
    <label for="content">Content</label><br>
    <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content', $post->content ?? null) }}</textarea>
</div>
<div class="form-group">
    <label class="" for="title">Thumbnail</label><br>
    <input type="file" name="thumbnail" />
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Send</button>
</div>
