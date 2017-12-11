@extends('selfcenter/selfcenter')
@section('subtitle')
    笔记本列表
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/mypage.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title">
            <div class="col-md-6"><p class="title-page">
                   搜索结果
                </p>
            </div>
        </div>
        <hr/>
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>标题</th>
                <th>简介</th>
                <th>作者</th>
                <th>标签</th>
                <th>创建日期</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notebooks as $notebook)
                <tr>
                    <td><a href="{{url('note',['id' => $notebook->bookid])}}">{{ $notebook->bookname }}</a></td>
                    <td>{{ $notebook->summary }}</td>
                    <td><a href="#">{{ $notebook->username }}</a></td>
                    <td>{{ $notebook->tag }}</td>
                    <td>{{ $notebook->created_at }}</td>
                    <td><a href="{{url('note',['id' => $notebook->bookid])}}">查看</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
