@if(count($replies))
    <ul class="list-group list-group-flush">
        @foreach($replies as $reply)
            <li class="list-group-item d-flex flex-column">
                <a class="text-decoration-none" href="{{route('topics.show',$reply->topic->id)}}">
                    <i class="fa-solid fa-location-dot"></i>&nbsp;
                    {{$reply->topic->title}}
                </a>
                <span class="text-success"><i class="fa-regular fa-comment-dots"></i>&nbsp;{!! $reply->content !!}</span>
                <small class="text-secondary">
                    <i class="fa-regular fa-clock"></i>
                    <span>回复于:</span>
                    <span>{{$reply->created_at->diffForHumans()}}</span>
                </small>
            </li>
        @endforeach
    </ul>
    @include('shared._page',['data'=>$replies])
@else
    @include('shared._no_data',['info'=>'TA还没有发过评论'])
@endif
