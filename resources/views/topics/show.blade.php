@extends('layouts.app')
@section('title',$topic->title)
@section('desc',$topic->desc)
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card d-none d-md-block">
                <div class="card-header bg-transparent">
                    <h5 class="text-center text-muted pt-2">作者 ：<span style="color:deeppink;">{{$topic->user->name}}</span></h5>
                </div>
                <div class="card-body">
                    <a href="{{route('users.show',$topic->user->id)}}">
                        <img src="{{asset($topic->user->avatar)}}" alt="avatar" class="img-thumbnail border-0 rounded">
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-primary text-center">{{$topic->title}}</h5>
                    <small class="text-secondary d-flex justify-content-center align-items-center">
                        <i class="fa-regular fa-user"></i>
                        <a class="text-decoration-none text-secondary"
                           href="{{route('users.show',$topic->user->id)}}">
                            {{$topic->user->name}}
                        </a>
                        <span>&nbsp;
                            •
                        </span>&nbsp;
                        <i class="fa-regular fa-comment-dots"></i>
                        {{$topic->reply_count}}
                        <span>&nbsp;
                            •
                        </span>&nbsp;
                        <i class="fa-regular fa-folder-closed"></i>
                        <a class="text-decoration-none text-secondary"
                           href="{{route('categories.show',$topic->category->id)}}">
                            {{$topic->category->name}}
                        </a>
                        <span>&nbsp;
                            •
                        </span>&nbsp;
                        <i class="fa-regular fa-clock"></i>
                        {{$topic->created_at->diffForHumans()}}
                    </small>
                    <div class="d-flex justify-content-center mt-2">
                        <a href="{{route('topics.create')}}" class="btn btn-outline-success btn-sm">
                            <i class="fa-solid fa-circle-plus"></i>
                            发帖
                        </a>
                        @can('update',$topic)
                        <a href="{{route('topics.edit',$topic->id)}}" class="btn btn-outline-primary btn-sm mx-3">
                            <i class="fa-solid fa-pen-to-square"></i>
                            编辑
                        </a>

                        <form action="{{route('topics.destroy',$topic->id)}}" method="POST" onsubmit="return confirm('您确定要删除该帖子吗?')">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fa-solid fa-trash-can"></i>
                                删除
                            </button>
                        </form>
                        @endcan
                    </div>
                    <div class="topic-body mt-4">
                        {!! $topic->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
