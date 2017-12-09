@extends('selfcenter/selfcenter')
@section('subtitle')
    用户信息
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/myinfo.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-3 col-md-7">
        <div class="row row-title">
            <div class="col-md-3"><p class="title-page">个人信息</p></div>
            <div class="col-md-offset-8"><a href="{{route('profileModify')}}" class="btn btn-sm btn-primary">编辑</a></div>
        </div>
        <hr/>
        <form class="form-horizontal">
            <div class="form-group">
                <label for="" class="control-label col-md-2">登录账号</label>
                {{Auth::user()->email}}
            </div>
            <div class="form-group">
                <label for="nickName" class="control-label col-md-2">昵称</label>
                {{Auth::user()->name}}
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">性别</label>
                {{ $profile->gender }}
            </div>
            <div class="form-group">
                <label for="area" class="control-label col-md-2">所在地</label>
                {{ $profile->address }}
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">生日</label>
                {{ $profile->birthday }}
            </div>
            <div class="form-group">
                <label for="description" class="control-label col-md-2">简介</label>
                @if($profile->introduction == NULL)
                    你还没有填写个人简介呢，点击右上角【编辑】，让大家更好地认识你吧~
                    @else
                {{$profile->introduction}}
                    @endif
            </div>
            <hr/>
            <div class="form-group">
                <label for="" class="control-label col-md-2">注册时间</label>
                {{ Auth::user()->created_at }}
            </div>
        </form>

    </div>
    </div>
@stop

