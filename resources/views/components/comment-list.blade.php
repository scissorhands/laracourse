@forelse($comments as $comment)
    <p>{{$comment->content}}</p>
    <x-tags :tags="$comment->tags"></x-tags>
    <x-updated
        :date="$comment->created_at"
        :userId="$comment->user_id"
        :name="$comment->user->name">
    </x-updated>
@empty
    <p>No comments yet.</p>
@endforelse
