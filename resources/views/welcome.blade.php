@extends('common/app')
@section('title')
    ProNote-笔记网
@stop
@section('css_extra_file')
    <link href="{{URL::asset('/css/cover.css')}}" rel="stylesheet">
    <link href="{{URL::asset('/css/signin.css')}}" rel="stylesheet">
@stop
@section('content')
    <div class="inner cover">
        @guest
            <h1 class="cover-heading">开始你的笔记之旅！</h1>
        @else
                <h1 class="cover-heading">欢迎您，{{ Auth::user()->name }}</h1>
            @endguest
                <p class="lead">记录生活的点滴，捕捉刹那的灵感，定格一瞬的思绪<br>爱上笔记，爱上生活</p>
        <p class="lead">
            @guest
                <a href="#" class="btn btn-lg btn-default" data-toggle="modal" data-target="#loginModal">点我开始</a>
                @else
                    <a href="{{route('notebook')}}" class="btn btn-lg btn-default">主页</a>
                @endguest
        </p>
    </div>
    @include('common/modal')
@stop