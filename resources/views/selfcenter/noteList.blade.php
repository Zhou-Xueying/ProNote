@extends('selfcenter/selfcenter')
@section('subtitle')
    笔记列表
@stop
@section('css_js_extra_file')
    <link href="{{URL::asset('/css/notebook.css')}}" rel="stylesheet">
@stop
@section('mainpart')
    <div class="col-md-offset-2 col-md-8">
        <div class="row row-title"><div class="col-md-6"><p class="title-page">我的笔记</p></div></div>
        <hr/>
        <table class="table table-hover table-striped" style="table-layout:fixed">
            @foreach($notes as $note)
                <tr>
                    <td style="white-space:nowrap; overflow:hidden; text-overflow: ellipsis; width: 50%">
                        {{ $note->content }}</td>
                    <td style="width: 15%"><a href="{{url('notebook/detail',['id' => $note->bookid])}}">{{ $note->bookname }}</a></td>
                    <td style="width: 20%">{{ $note->updated_at }}</td>
                    <td>
                        <a href="{{ url('note/detail', ['id' => $note->noteid]) }}">查看</a>
                        <a href="{{ url('note/delete', ['id' => $note->noteid]) }}"
                           onclick="if (confirm('确定要删除吗？') == false) return false;">删除</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@stop