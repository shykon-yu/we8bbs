<li class="list-group-item d-flex text-secondary">
    <a href="{{route('users.show',$notification->data['user_id'])}}" class="flex-shrink-0">
        <img class="img-thumbnail" width="50" src="{{$notification->data['user_avatar']}}" alt="avatar">
    </a>
    <div class="px-3 flex-grow-1">
        <small>
            <a class="text-decoration-none" href="{{route('users.show',$notification->data['user_id'])}}">
                {{$notification->data['user_name']}}
            </a>
            <span>评论了</span>
            <a class="text-decoration-none" href="{{$notification->data['topic_link']}}">
                {{$notification->data['topic_title']}}
            </a>
        </small>
        <div class="text-success">
            {!! $notification->data['reply_content'] !!}
        </div>
    </div>
    <small style="min-width: max-content;">
        <i class="fa-regular fa-clock"></i>
        {{$notification->created_at->diffForHumans()}}
    </small>
</li>
