<div class="card">
    <div class="card-body">
        <a href="{{route('topics.create')}}" class="btn btn-primary w-100">
            <i class="fa-solid fa-square-pen"></i>
            我要发帖
        </a>
    </div>
</div>
@if(count($active_users))
    <div class="card mt-4">
        <div class="card-header bg-transparent text-primary text-center">
            <i class="fa-solid fa-jet-fighter-up"></i>
            活跃用户
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach($active_users as $user)
                    <li class="list-group-item">
                        <a class="text-decoration-none" href="{{route('users.show',$user->id)}}">
                            <img src="{{ asset($user->avatar ?? 'default-avatar.png') }}" alt="avatar" class="img-thumbnail" width="50"/>
                        </a>
                        <a class="text-muted text-decoration-none" href="{{route('users.show',$user->id)}}">
                            {{$user->name}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(count($links))
    <div class="card mt-4">
        <div class="card-header bg-transparent text-danger text-center">
            <i class="fa-solid fa-earth-americas"></i>
            站长推荐
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach($links as $link)
                    <li class="list-group-item">
                        <a class="text-muted text-decoration-none" href="{{$link->link}}">
                            <i class="fa-solid fa-fire-flame-curved text-primary"></i>
                            {{$link->title}}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
