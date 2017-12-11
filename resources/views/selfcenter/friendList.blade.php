@extends('selfcenter/selfcenter')
@section('subtitle')
    好友列表
@stop
@section('css_js_extra_file')
    {{--<link href="{{URL::asset('/css/notebook.css')}}" rel="stylesheet">--}}
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title">
            <div class="col-md-6"><p class="title-page">我的好友</div>
        </div>
        <hr/>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>用户名</th>
                    <th>简介</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->introduction }}</td>
                    <td>
                        <a href="{{url('notebook/friend',['userid'=>$user->userid, 'username'=>$user->name])}}">他的主页</a>
                        <a href="{{url('profile',['userid'=>$user->userid])}}">他的资料</a>
                        <a href="{{url('friend/delete',['userid'=>$user->userid])}}"
                           onclick="if (confirm('确定要解除和他的好友关系吗？') == false) return false;">解除好友</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop