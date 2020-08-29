@component('mail::message')
# Comment was posted on post you are watching

Hi {{ $user->name }}

Someone has posted on yout blog post

@component('mail::button', ['url' => route('posts.show', ['post' => $comment->commentable->id])])
View the Blog Post
@endcomponent

@component('mail::button', ['url' => route('users.show', ['user'=>$comment->user->id])])
Visit {{ $comment->user->name }} Profile
@endcomponent

@component('mail::panel')
{{ $comment->content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
