@if(count($topics))
    <ul class="list-group mt-4">
        @foreach($topics as $topic)
            <li class="list-group-item d-flex justify-content-between border-0 border-bottom">
                <a class="flex-grow-1 text-success text-decoration-none pe-1"
                   href="{{route('topics.show',$topic->id)}}">
                    {{$topic->title}}
                </a>
                <small class="text-muted" style="min-width:max-content;">
                    <i class="fa-regular fa-comment-dots"></i>
                    <a class="text-muted text-decoration-none"
                       href="{{route('topics.show',$topic->id)}}">{{$topic->reply_count}}</a>
                    <span>
                    •
                </span>
                    <i class="fa-regular fa-clock"></i>
                    {{$topic->created_at->diffForHumans()}}
                </small>
            </li>
        @endforeach
    </ul>
    @include('shared._page',['data'=>$topics])
@else
    @include('shared._no_data',['info'=>'还没有帖子哦'])
@endif
