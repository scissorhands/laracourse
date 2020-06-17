@extends('templates.layout')
@section('content')
    <div class="row">
        <div class="col-sm-8">
            @forelse ($posts as $post)
                <div class="col-sm-12" style="padding-top: 28px">
                    @if($post->trashed())
                        <del>
                    @endif
                        <h3><a class="{{ $post->trashed() ? 'text-muted' : '' }}" href="{{ route('posts.show', ['post'=>$post->id]) }}">{{ $post->title }}</a></h3>
                    @if($post->trashed())
                       </del>
                    @endif

                    <p class="text-muted">
                        Added {{ $post->created_at->diffForHumans() }}
                        by {{ $post->user->name }}
                    </p>
                    
                    @if($post->comments_count)
                        <p>{{ $post->comments_count }} comments</p>
                    @else
                        <p>No comments</p>
                    @endif
                    @can('update', $post)
                        <a class="btn btn-secondary btn-sm" href="{{ route('posts.edit', ['post'=>$post->id]) }}">Edit</a>
                    @endcan

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
                </div>
            @empty
                <p>No posts</p>
            @endforelse
        </div>
        <div class="col-sm-4">
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 18rem">
                        <div class="card-body">
                            <h5 class="card-title">Most Commented</h5>
                            <p class="card-text mb-2 text-muted">What people are talking about</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($most_commented as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', $post->id)}}">
                                        {{ $post->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="card" style="width: 18rem">
                        <div class="card-body">
                            <h5 class="card-title">Most Active Users</h5>
                            <p class="card-text mb-2 text-muted">Users with most posts written</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($most_active_users as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="card" style="width: 18rem">
                        <div class="card-body">
                            <h5 class="card-title">Most Active Users Last Month</h5>
                            <p class="card-text mb-2 text-muted">Users with most posts written last month</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($most_active_last_month as $user)
                                <li class="list-group-item">
                                    {{ $user->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
