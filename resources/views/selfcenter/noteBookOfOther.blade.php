@extends('selfcenter/selfcenter')
@section('subtitle')
    笔记本
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/mypage.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title">
            <div class="col-md-6"><p class="title-page">
                    {{$username}}的笔记本
                </p>
            </div>
        </div>
        <hr/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>标题</th>
                <th>简介</th>
                <th>创建日期</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notebooks as $notebook)
                <tr>
                    <td><a href="{{url('notebook/detail',['id' => $notebook->bookid])}}">{{ $notebook->bookname }}</a></td>
                    <td>{{ $notebook->summary }}</td>
                    <td>{{ $notebook->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop */