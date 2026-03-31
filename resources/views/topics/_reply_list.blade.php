<ul class="list-group list-group-flush">
    @foreach($replies as $reply)
        <li class="list-group-item d-flex align-items-center">
            <a href="{{route('users.show',$reply->user->id)}}" class="flex-shrink-0">
                <img src="{{asset($reply->user->avatar)}}" alt="avatar"  class="img-thumbnail" width="50"/>
            </a>
            <section class="px-2 flex-grow-1">
                <small class="text-muted">
                    <span >
                        <i class="fa-regular fa-user"></i>
                        <a class="text-decoration-none" href="{{route('users.show',$reply->user->id)}}">{{$reply->user->name}}</a>
                    </span>

                    <span>&nbsp;•&nbsp;</span>
                    <span>
                        <i class="fa-regular fa-clock"></i>
                        <span>{{$reply->created_at->diffForHumans()}}</span>
                    </span>
                </small>
                <div class="text-success">{{ strip_tags($reply->content) }}<!--解决出现p的问题--></div>
            </section>
            @can('delete',$reply)
                <form action="{{route('replies.destroy',$reply->id)}}" method="POST" class="small text-secondary" onsubmit="return confirm('确定删除吗？')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-default btn-sm">
                        <i class="fa-solid fa-trash-can text-secondary"></i>
                    </button>
                </form>
            @endcan

        </li>

    @endforeach
        @include('shared._page',['data'=>$replies])
</ul>
