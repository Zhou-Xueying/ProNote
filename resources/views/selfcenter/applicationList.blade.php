@extends('selfcenter/selfcenter')
@section('subtitle')
    好友列表
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/notebook.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title">
            <div class="col-md-6"><p class="title-page">好友申请</div>
        </div>
        <hr/>
        <table class="table table-hover table-striped">
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
                    <td><a href="#">{{ $user->name }}</a></td>
                    <td>{{ $user->introduction }}</td>
                    <td>
                        <a href="{{url('notebook/stranger',['userid'=>$user->userid, 'username'=>$user->name])}}">主页</a>
                        <a href="{{url('profile',['userid'=>$user->userid])}}">资料</a>
                        <a href="{{url('friend/agree',['userid'=>$user->userid])}}"
                           onclick="if (confirm('要添加为好友吗？') == false) return false;">同意</a>
                        <a href="{{url('friend/refuse',['userid'=>$user->userid])}}"
                           onclick="if (confirm('要拒绝该请求吗？') == false) return false;">拒绝</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop