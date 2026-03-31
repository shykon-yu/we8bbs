@extends('layouts.app')
@section('title','个人中心')
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <img class="img-thumbnail border-0 rounded" src="{{asset($user->avatar)}}" alt="avatar">
                <div class="card-body">
                    <hr>
                    <h5 class="text-muted text-center">
                        <i class="fa-solid fa-user-tie"></i>
                        用户名
                    </h5>
                    <h4 class="text-success text-center">
                        {{$user->name}}
                    </h4>
                    <hr>
                    <h5 class="text-muted text-center">
                        <i class="fa-solid fa-clipboard"></i>
                        个人简介
                    </h5>
                    <p class="text-success text-center">{{$user->introduction}}</p>
                    <hr>
                    <h5 class="text-muted text-center">
                        <i class="fa-regular fa-clock"></i>
                        注册时间
                    </h5>
                    <p class="text-success text-center">{{$user->created_at->diffForHumans()}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h1>{{$user->name}}--<small>{{$user->email}}</small></h1>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link {{active_class(if_query('tab',null))}}" aria-current="page" href="{{route('users.show',$user->id)}}">TA的帖子</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{active_class(if_query('tab','replies'))}}" href="{{route('users.show',[$user->id,'tab'=>'replies'])}}">TA的评论</a>
                            </li>
                        </ul>
                        @if(if_query('tab','replies'))
                            @include('users._replies',['replies'=>$user->replies()->with('topic')->recent()->paginate(10)])
                        @else
                            @include('users._topics',['topics'=>$user->topics()->recent()->paginate(10)])
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
