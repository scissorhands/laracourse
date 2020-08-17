<p>
    @foreach ($tags as $tag)
        <a href="{{ route('posts.tags.index', $tag->id) }}" class="badge badge-success lg-badge">
            {{ $tag->name }}
        </a>
    @endforeach
</p>
