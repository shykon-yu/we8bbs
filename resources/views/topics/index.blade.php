@extends('layouts.app')
@section('title',isset($category)?$category->name:'帖子列表')
@section('content')
    <div class="row">
        <div class="col-md-9">
            @if(isset($category))
                <div class="alert alert-info" role="alert">
                    <i class="fa-brands fa-app-store"></i>
                    {{$category->name}} : {{$category->description}}
                </div>
            @endif
            <div class="card">
                <div class="card-header bg-transparent">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link {{active_class(!if_query('order','recent'))}}" aria-current="page" href="{{Request::url()}}?order=default">最后评论</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{active_class(if_query('order','recent'))}}" href="{{Request::url()}}?order=recent">最新帖子</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    @include('topics._topic_list',['topics'=>$topics])
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('topics._siderbar')
        </div>
    </div>
@endsection
