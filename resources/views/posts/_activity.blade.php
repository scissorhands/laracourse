<div class="container">
    <div class="row mt-4">
        <x-card
        title="Most Commented"
        subtitle="What people are talking about">
            @slot('items')
                @foreach($mostCommented as $post)
                <li class="list-group-item">
                    <a href="{{ route('posts.show', ['post'=>$post->id]) }}">
                        {{ $post->title }}
                    </a>
                </li>
                @endforeach
            @endslot
        </x-card>
    </div>
    <div class="row mt-4">
        <x-card
        title="Most Active Users"
        subtitle="Users with most posts written"
        :items="collect($mostActiveUsers)->pluck('name')">
        </x-card>
    </div>
    <div class="row mt-4">
        <x-card
        title="Most Active Users Last Month"
        subtitle="Users with most posts written last month"
        :items="collect($mostActiveLastMonth)->pluck('name')">
        </x-card>
    </div>
</div>
