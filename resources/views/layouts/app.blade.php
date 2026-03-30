<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="@yield('desc','we8bbs实况论坛')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title','实况8联盟')</title>
    @yield('editor_css')
    @yield('editor_js')
</head>
<body>
@include('layouts._header')

<div id="app" class="container">
    @include('shared._messages')
    @yield('content')
</div>
@include('layouts._footer')

</body>
</html>
