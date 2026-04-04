@extends('layouts.app')
@section('title','无权访问')

@section('content')
    <div class="row">
        <div class="offset-md-4 col-md-4">
            @if(Auth::check())
                <div class="alert alert-warning text-center">
                    <i class="fa-solid fa-bell me-1"></i>
                    <span>非法访问</span>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="fa-solid fa-bell me-1"></i>
                    <span>请先登录</span>
                    <a href="{{route('login')}}">
                        登录
                    </a>
                </div>
            @endif
        </div>
    </div>
@stop
