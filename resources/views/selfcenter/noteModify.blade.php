@extends('selfcenter/selfcenter')
@section('subtitle')
    笔记列表
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/notebook.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title">
            <div class="col-md-6"><p class="title-page">{{$notebook->bookname}}</p></div>
            <div class="col-md-offset-8"><a href="{{url('note/detail', ['id' => $note->noteid])}}" class="btn btn-md">返回</a></div>
        </div>
        <br/>
        <div><p style=": 200;font-size: 20px;">{{ $notebook->summary }}</p></div>
        <div class="col-md-offset-6"><p style=";font-size: 15px; ">建立时间：{{ $notebook->created_at }}</p></div>
        <hr/>
        <hr/>
        <div class="col-md-10">
            <form method="post" action="{{route('updateNote')}}">
                {{ csrf_field() }}
                <input type="hidden" name="noteid" value="{{$note->noteid}}">
                <div class="form-group">
                    <label for="content" class="control-label col-md-2" hidden>简介</label>
                    <textarea id="content" class="form-control" type="text"
                         style="min-height: 200px; max-width: 600px;" name="content" >{{$note->content}}</textarea>
                </div>
                <div class="col-md-offset-3 col-md-5">
                    <button type="submit" class="btn btn-block btn-primary" style="margin-top:25px;">保存</button>
                </div>
            </form>
        </div>
    </div>
@stop
