@extends('selfcenter/selfcenter')
@section('subtitle')
    用户信息
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/static/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" media="screen">
    <link href="{{URL::asset('/css/myinfo.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-3 col-md-7">
        <div class="row row-title">
            <div class="col-md-3"><p class="title-page">个人信息</p></div>
            <div class="col-md-offset-8">
                <a href="{{route('profile')}}" class="btn btn-md">返回</a>
            </div>
        </div>
        <hr/>
        <form class="form-horizontal" method="post" action="{{route('updateProfile')}}">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="" class="control-label col-md-2">登录账号</label>
                {{Auth::user()->email}}<a href="#" class="btn btn-link" data-toggle="modal" data-target="#resetModal">重置密码</a>
            </div>
            <div class="form-group">
                <label for="nickName" class="control-label col-md-2">用户名</label>
                <input type="text" id="nickName" name="name" value="{{Auth::user()->name}}"/>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2">性别</label>
                <label class="radio-inline">
                    <input type="radio" id="inlineRadio1" name="gender" value="男" <?=$profile->gender=='男'?'checked':'';?>> 男
                </label>
                <label class="radio-inline">
                    <input type="radio" id="inlineRadio2" name="gender" value="女" <?=$profile->gender=='女'?'checked':'';?>> 女
                </label>
            </div>
            <div class="form-group">
                <label for="area" class="control-label col-md-2">所在地</label>
                <select class="form-control choice" id="addressChoice" name="address">
                    <option <?=$profile->address=='河北省'?'selected':'';?>>河北省</option>
                    <option <?=$profile->address=='山西省'?'selected':'';?>>山西省</option>
                    <option <?=$profile->address=='辽宁省'?'selected':'';?>>辽宁省</option>
                    <option <?=$profile->address=='吉林省'?'selected':'';?>>吉林省</option>
                    <option <?=$profile->address=='黑龙江省'?'selected':'';?>>黑龙江省</option>
                    <option <?=$profile->address=='江苏省'?'selected':'';?>>江苏省</option>
                    <option <?=$profile->address=='浙江省'?'selected':'';?>>浙江省</option>
                    <option <?=$profile->address=='安徽省'?'selected':'';?>>安徽省</option>
                    <option <?=$profile->address=='福建省'?'selected':'';?>>福建省</option>
                    <option <?=$profile->address=='江西省'?'selected':'';?>>江西省</option>
                    <option <?=$profile->address=='山东省'?'selected':'';?>>山东省</option>
                    <option <?=$profile->address=='河南省'?'selected':'';?>>河南省</option>
                    <option <?=$profile->address=='湖北省'?'selected':'';?>>湖北省</option>
                    <option <?=$profile->address=='湖南省'?'selected':'';?>>湖南省</option>
                    <option <?=$profile->address=='广东省'?'selected':'';?>>广东省</option>
                    <option <?=$profile->address=='海南省'?'selected':'';?>>海南省</option>
                    <option <?=$profile->address=='四川省'?'selected':'';?>>四川省</option>
                    <option <?=$profile->address=='贵州省'?'selected':'';?>>贵州省</option>
                    <option <?=$profile->address=='云南省'?'selected':'';?>>云南省</option>
                    <option <?=$profile->address=='陕西省'?'selected':'';?>>陕西省</option>
                    <option <?=$profile->address=='甘肃省'?'selected':'';?>>甘肃省</option>
                    <option <?=$profile->address=='青海省'?'selected':'';?>>青海省</option>
                    <option <?=$profile->address=='台湾省'?'selected':'';?>>台湾省</option>
                    <option <?=$profile->address=='内蒙古自治区'?'selected':'';?>>内蒙古自治区</option>
                    <option <?=$profile->address=='西藏自治区'?'selected':'';?>>西藏自治区</option>
                    <option <?=$profile->address=='广西壮族自治区'?'selected':'';?>>广西壮族自治区</option>
                    <option <?=$profile->address=='宁夏回族自治区'?'selected':'';?>>宁夏回族自治区</option>
                    <option <?=$profile->address=='新疆维吾尔自治区'?'selected':'';?>>新疆维吾尔自治区</option>
                </select>
            </div>
            <div class="form-group">
                <label for="dtp_input" class="control-label col-md-2">生日</label>
                <div class="input-group date form_date col-md-5" data-date=""
                     data-date-format="dd MM yyyy" data-link-field="dtp_input"
                     data-link-format="yyyy-mm-dd" style="padding-left:0;width:200px;">
                    <input class="form-control" size="16" type="text" value="{{$profile->birthday}}">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" id="dtp_input" value="{{$profile->birthday}}" name="birthday"/><br/>
            </div>
            <div class="form-group">
                <label for="description" class="control-label col-md-2">简介</label>
                <textarea id="description" class="form-control description" type="text"
                          name="introduction" >{{$profile->introduction}}</textarea>
            </div>
            <div class="col-md-offset-2 col-md-5">
                <button type="submit" class="btn btn-block btn-primary" style="margin-top:25px;">保存</button>
            </div>
        </form>

    </div>
    </div>
    {{--@include('common/modal')--}}
@stop

@section('css_js_extra_text')
    <script type="text/javascript" src="{{ URL::asset('/static/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>

    <script type="text/javascript">
        $('.form_date').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
    </script>
@stop
