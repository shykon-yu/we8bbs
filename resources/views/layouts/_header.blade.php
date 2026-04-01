<nav class="navbar navbar-expand-lg shadow-sm my_navbar">
    <div class="container">
        <a class="navbar-brand d-flex justify-content-start align-items-center" href="#">
            <img width="50" class="d-inline-block align-text-center me-2" src="{{url('pics/logo/we8logo.png')}}" alt="logo">
            we8bbs
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{active_class(if_route('topics.index'))}}" aria-current="page" href="{{route('topics.index')}}">帖子</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{category_navbar_active(1)}}" href="{{route('categories.show',1)}}">WRH</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{category_navbar_active(2)}}" href="{{route('categories.show',2)}}">NO.1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{category_navbar_active(3)}}" href="{{route('categories.show',3)}}">BF</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{category_navbar_active(4)}}" href="{{route('categories.show',4)}}">AJ</a>
                </li>
            </ul>
            @guest
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">注册</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">登录</a>
                    </li>
                </ul>
            @else
                <li class="nav-item d-flex align-items-center  me-3">
                    <a href="{{route('topics.create')}}" title="我要发帖" class="text-primary text-decoration-none d-flex align-items-center gap-1">
                        <i class="fa-solid fa-plus"></i>
                        发帖
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center">
                    <a class="text-decoration-none px-2 text-{{Auth::user()->notification_count > 0 ? 'danger' : 'secondary'}} d-flex align-items-center"
                       href="{{route('notifications.index')}}"
                       title="消息通知">
                        <i class="fa-solid fa-bell me-1"></i>
                        <span class="badge rounded-pill  text-bg-{{Auth::user()->notification_count > 0 ? 'danger' : 'secondary'}}">
                                {{Auth::user()->notification_count}}
                            </span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset(Auth::user()->avatar)}}" width="40" alt="avatar" class="img-thumbnail"/>
                        {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li class="text-center">
                            <a class="dropdown-item" href="{{route('users.show',Auth::id())}}">
                                <i class="fa-solid fa-user-tie"></i>
                                个人空间
                            </a>
                        </li>
                        <li class="text-center">
                            <a class="dropdown-item" href="{{route('users.edit',Auth::id())}}">
                                <i class="fa-solid fa-pen-to-square"></i>
                                编辑资料
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li class="text-center">
                            <form action="{{route('logout')}}" method="POST" onsubmit="return confirm('您是否真的要退出登录？')">
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i>退出
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest

        </div>
    </div>
</nav>
