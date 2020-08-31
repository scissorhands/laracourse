@component('mail::message')
# Comment was posted on post you are watching

Hi {{ $user->name }}

{{ $comment->user->name }} has commented on a blog post you're watching..

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
View the Blog Post
@endcomponent

@component('mail::panel')
{{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
