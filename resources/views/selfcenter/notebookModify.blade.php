@extends('selfcenter/selfcenter')
@section('subtitle')
笔记本列表
@stop
@section('css_js_extra_file')
<link href="{{URL::asset('/css/mypage.css')}}" rel="stylesheet">
@stop
@section('mainpart')
<div class="col-md-offset-3 col-md-5">
    <div class="row">
        <div class="col-md-3"><p class="title-page">编辑</p></div>
        <div class="col-md-offset-10"><a href="{{route('notebook')}}" class="btn btn-md">返回</a></div>
    </div>
    <hr/>
    <form class="form-horizontal" method="post" action="{{route('updateBook')}}">
        {{ csrf_field() }}
        <input type="hidden" name="bookid" value="{{$notebook->bookid}}"/>
        <div class="form-group">
            <label for="inputBookName" class="control-label" style="font-size: 20px;">笔记本名</label>
            <input id="inputBookName" class="form-control" required="" autofocus="" type="text" name="bookname" value="{{$notebook->bookname}}">
        </div>
        <div class="form-group">
            <label for="inputBookDescription" class="control-label" style="font-size: 20px;">描述</label>
            <textarea id="inputBookDescription" class="form-control" required="" type="text" name="summary" style="min-height: 160px;">{{$notebook->summary}}</textarea>
        </div>
        <div class="form-group">
            <label for="inputBookTag" class="control-label">标签</label>
            <input id="inputBookTag" class="form-control" required="" autofocus="" type="text" name="tag" value="{{$notebook->tag}}">
        </div>
        <div class="radio-inline">
            <label>
                <input type="radio" name="authority" id="optionsRadios1" value="公开" <?=$notebook->authority=='公开'?'checked':'';?>>公开
            </label>
        </div>
        <div class="radio-inline">
            <label>
                <input type="radio" name="authority" id="optionsRadios2" value="好友可见" <?=$notebook->authority=='好友可见'?'checked':'';?>>好友可见
            </label>
        </div>
        <div class="radio-inline">
            <label>
                <input type="radio" name="authority" id="optionsRadios3" value="私密" <?=$notebook->authority=='私密'?'checked':'';?>>私密
            </label>
        </div>
        <div class="col-md-offset-10">
            <button class="btn btn-lg btn-primary" type="submit">确认</button>
        </div>
    </form>
</div>
@stop