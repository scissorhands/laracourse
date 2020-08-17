<div class="card" style="width: 18rem">
    <div class="card-body">
        <h5 class="card-title">
        	{{ $title }}
        </h5>
        <p class="card-text mb-2 text-muted">
        	{{ $subtitle }}
        </p>
    </div>
    <ul class="list-group list-group-flush">
        @if(is_a($items, 'Illuminate\Support\Collection'))
        @foreach($items as $item)
            <li class="list-group-item">
            	{{ $item }}
            </li>
        @endforeach
        @else
        	{{ $items }}
        @endif
    </ul>
</div>