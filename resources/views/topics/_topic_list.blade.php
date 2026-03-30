@if( count($topics) )
    <ul class="list-group">
        @foreach($topics as $topic)
            <li class="list-group-item border-0 border-bottom d-flex align-items-center">
                <a href="{{route('users.show',$topic->user_id)}}" class="flex-shrink-0 text-decoration-none">
                    <img src="{{asset($topic->user->avatar)}}" alt="avatar" class="img-thumbnail" width="50"/>
                </a>
                <div class="flex-grow-1 px-2 d-flex flex-column">
                    <a class="text-decoration-none text-success"
                       href="{{$topic->link()}}">{{$topic->title}}
                    </a>
                    <small>
                        <a href="{{route('categories.show',$topic->category_id)}}" class="text-muted text-decoration-none">
                            <i class="fa-regular fa-folder-closed"></i>
                            {{$topic->category->name}}
                        </a>
                        <span>  •   </span>
                        <a href="{{route('users.show',$topic->user_id)}}" class="text-muted text-decoration-none">
                            <i class="fa-regular fa-user"></i>
                            {{$topic->user->name}}
                        </a>
                        <span>  •   </span>
                        <span class="text-muted">
                                            <i class="fa-regular fa-clock"></i>
                                            {{$topic->created_at->diffForHumans()}}
                                        </span>
                    </small>
                </div>
                <a href="{{route('topics.show',$topic->id)}}"
                   class="text-decoration-none badge text-bg-{{$topic->reply_count > 0 ? 'danger' : 'secondary'}}">
                    {{$topic->reply_count}}
                </a>
            </li>
            {{--                            <div class="flex-grow-1 px-2">main</div>--}}
            {{--                            <span class="badge text-bg-secondary">Secondary</span>--}}
        @endforeach
    </ul>
    <div>
        {{ $topics->withQueryString()->links() }}
    </div>
@else
    @include('shared._no_data',['info'=>'无帖子'])

@endif
