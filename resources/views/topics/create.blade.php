@extends('layouts.app')
@section('title','发布帖子')
@section('editor_css')
    <link rel="stylesheet" href="/editor/css/simditor.css">
@stop


@section('editor_js')
    <script src="/editor/js/jquery-2.0.3.min.js"></script>
    <script src="/editor/js/simple-module.js"></script>
    <script src="/editor/js/simple-hotkeys.js"></script>
    <script src="/editor/js/simple-uploader.js"></script>
    <script src="/editor/js/simditor.js"></script>


@stop
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header ">
                    <h3 class="pt-2 text-center">
                        <i class="fa-solid fa-pencil"></i>
                        发布帖子
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{route('topics.store')}}" method="POST" accept-charset="UTF-8" >
                        @csrf
                        @include('shared._errors')
                        <div class="mb-3">
                            <label for="title" class="form-label">帖子标题</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="请输入帖子标题" value="{{old('title')}}">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">所属分类</label>
                            <select name="category_id" class="form-select" aria-label="选择分类">
                                <option selected>请选择分类</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">帖子内容</label>
                            <textarea name="content"  placeholder="请输入帖子内容" class="form-control" id="editor" rows="3">{{old('content')}}</textarea>
                        </div>
                        <script>
                            // 等页面 完全 加载完毕再执行
                            window.onload = function() {
                                console.log('Simditor 开始初始化');
                                var editor = new Simditor({
                                    textarea: $('#editor'),
                                    upload:{
                                        url:'{{route('topics.upload_image')}}',
                                        params:{
                                            _token:'{{csrf_token()}}'
                                        },
                                        fileKey:'upload_file',
                                        connectionCount:5,
                                        leaveConfirm:'图片上传中，请不要走开',
                                    },
                                    pasteImage:true
                                });
                            };
                        </script>
                        <hr>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
