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
            <div class="col-md-offset-8">
                <a href="{{ route('otherNotes', ['id' => $notebook->bookid]) }}" class="btn btn-md">返回</a>
            </div>
        </div>
        <br/>
        <div><p style=": 200;font-size: 20px;">{{ $notebook->summary }}</p></div>
        <div class="col-md-offset-6"><p style=";font-size: 15px; ">建立时间：{{ $notebook->created_at }}</p></div>
        <hr/>
        <hr/>
        <div class="col-md-10">
            {{$note->content}}
            <div style="margin: 50px;"/>
            <p style="text-align: right">发表于：{{ $note->created_at }}</p>
            <p style="text-align: right">最后一次更新于: {{ $note->updated_at }}</p>
        </div>
    </div>
@stop
