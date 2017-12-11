@extends('common/app')
@section('title')
    笔记网-@yield('subtitle')
@stop
@section('css_extra_file')
    <link href="{{URL::asset('/css/sidebar.css')}}" rel="stylesheet">
    @yield('css_js_extra_file')
@stop
@section('content')
    <div id="wrapper">
        <div class="overlay"></div>

        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand"><a href="#">Bootstrap 3</a></li>
                <li><a href="{{route('welcome')}}"><i class="fa fa-fw fa-home"></i> 首页</a></li>
                <li><a href="{{route('notebook')}}"><i class="fa fa-fw fa-folder"></i> 我的笔记本</a></li>
                <li><a href="{{route('allNotes')}}"><i class="fa fa-fw fa-file-o"></i> 我的笔记</a></li>
                <li><a href="#"><i class="fa fa-fw fa-cog"></i> 设置</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-plus"></i> 好友圈 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('friendList')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;好友列表</a></li>
                        <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;收到分享</a></li>
                        <li><a href="{{route('applicationList')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;消息通知</a></li>
                    </ul>
                </li>
                <li><a href="{{route('profile')}}"><i class="fa fa-fw fa-bank"></i> 个人中心</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-dropbox"></i> 回收站 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        {{--<li class="dropdown-header">Dropdown heading</li>--}}
                        <li><a href="{{route('bookBin')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;笔记本</a></li>
                        <li><a href="{{route('noteBin')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;笔记</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="fa fa-fw fa-twitter"></i> 链接</a></li>
            </ul>
        </nav>

        <div id="page-content-wrapper">
            <button type="button" class="hamburger is-closed animated fadeInLeft" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            @yield('mainpart')
        </div>
    </div>
    @yield('modal-fade')

@stop

@section('js_extra_text')
    <script type="text/javascript">
        $(document).ready(function () {
            var trigger = $('.hamburger'),
                overlay = $('.overlay'),
                isClosed = false;

            trigger.click(function () {
                hamburger_cross();
            });

            function hamburger_cross() {

                if (isClosed == true) {
                    overlay.hide();
                    trigger.removeClass('is-open');
                    trigger.addClass('is-closed');
                    isClosed = false;
                } else {
                    overlay.show();
                    trigger.removeClass('is-closed');
                    trigger.addClass('is-open');
                    isClosed = true;
                }
            }

            $('[data-toggle="offcanvas"]').click(function () {
                $('#wrapper').toggleClass('toggled');
            });
        });
    </script>
    @yield('css_js_extra_text')
@stop