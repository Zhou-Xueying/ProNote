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
            <div class="col-md-offset-8"><a href="{{route('notebook') }}" class="btn btn-lg">返回</a></div>
        </div>
        <br/>
        <div><p style="font-size: 20px;">{{ $notebook->summary }}</p></div>
        <div class="col-md-offset-6"><p style=";font-size: 15px; ">建立时间：{{ $notebook->created_at }}</p></div>
        <hr/>
        <table class="table table-hover table-striped" style="table-layout:fixed">
            @foreach($notes as $note)
                <tr>
                    <td style="white-space:nowrap; overflow:hidden; text-overflow: ellipsis; width: 70%">{{ $note->content }}</td>
                    <td style="width:20%;">{{ $note->updated_at }}</td>
                    <td><a href="{{ url('note/other', ['id' => $note->noteid]) }}">查看</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@stop