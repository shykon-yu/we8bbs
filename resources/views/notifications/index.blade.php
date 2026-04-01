@extends('layouts.app')
@section('title','我的消息通知列表')
@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-transparent h5 p-4 text-center text-primary">
                    <i class="fa-regular fa-bell"></i>
                    我的消息通知列表
                </div>
                <div class="card-body">
                    @if($notifications->count())
                        <ul class="list-group list-group-flush">
                            @foreach($notifications as $notification)
                                @include('notifications.types._'.Str::snake(class_basename($notification->type)))
                            @endforeach
                        </ul>
                        @include('shared._page',['data'=>$notifications])
                    @else
                        @include('shared._no_data',['info'=>'暂未收到消息通知'])
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
