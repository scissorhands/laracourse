@extends('templates.layout')
@section('content')
    <div class="row">
        <div class="col-8">
            @forelse ($posts as $post)
                <div class="col-sm-12" style="padding-top: 28px">
                    @if($post->trashed())
                        <del>
                    @endif
                        <h3><a class="{{ $post->trashed() ? 'text-muted' : '' }}" href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a></h3>
                    @if($post->trashed())
                       </del>
                    @endif

                    <x-updated
                        :date="$post->created_at"
                        :name="$post->user->name"
                        :userId="$post->user->id">
                    </x-updated>
                    <x-tags :tags="$post->tags"></x-tags>

                    {{ trans_choice('messages.comments', $post->comments_count) }}

                    @auth
                        @can('update', $post)
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('posts.edit', ['post'=>$post->id]) }}">
                                Edit
                            </a>
                        @endcan
                    @endauth

                    @auth
                    @if(!$post->trashed())
                        @can('delete', $post)
                            <form method="POST" class="form" style="display: inline"
                                action="{{ route('posts.destroy', ['post'=>$post->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        @endcan
                    @endif
                    @endauth
                </div>
            @empty
                <p>No posts</p>
            @endforelse
        </div>
        <div class="col-sm-4">
            @include('posts._activity')
        </div>
    </div>
@endsection
